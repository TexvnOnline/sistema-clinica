<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DisableDate;
use App\DisableTime;

class DoctorSchedule extends Model
{
    protected $fillable = [
        'key', 'value', 'user_id',
    ];

    // RELACIONES
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Ahora lo que tenemos que hacer es almacenar estos valores en nuestra tabla de la base de datos llamada disble_dates con el key manual.
    // Este key indica que la deshabilitación de la fecha es demanera manual e intencional por el usuario.
    public function disable_dates($request, $user){
        //Ahora debemos procesar las fechas para que las podamos manipular con javascript.
        $disabled_dates = new DisableDate();
        $values = $disabled_dates->process_disabled_dates($request->multi_date_input);
        //Actualizar o almacenar las fechas
        DisableDate::updateOrCreate([
                'user_id' => $user->id
            ],[
                'key' => 'manual',
                'value' => $values
        ]);
    }

    public function disable_work_days($request, $user)
    {
        $days_off = implode('-',$request->week_days_off);
        //Actualizar o almacenar las fechas
        DisableDate::updateOrCreate([
                'user_id' => $user->id,
                'key' => 'days_off',
            ],[
                'value' => $days_off
        ]);
    }

    public function disable_hours($request, $user)
        {
            // Este valor va a almacenar las horas de entrada y salida  para cada día
        $value = [];

        // Establecer los días no laborales. Esto es para validar si se deben o no procesar los horarios
        $days_off = explode('-', $user->days_off());

        // Jornada laboral por defecto.
        // Este apartado lo debemos modificar mas adelante para que sea dinámico. Por ahora lo vamos a hacer en código duro
        $default_a_in = strtotime('8:00');
        $default_a_out = strtotime('13:00');
        $default_b_in = strtotime('15:00');
        $default_b_out = strtotime('20:00');

        //Debemos procesar los 7 días de la semana.
        for ($i=1; $i < 7; $i++) { 
            
            // Validar que este día no esté deshabilitado
            if (!in_array($i, $days_off)) {
                // Vamos a declarar las variables que debemos procesar por día
                $turn_a_in = $i . '-turn_a_in';
                $turn_a_out = $i . '-turn_a_out';
                $turn_b_in = $i . '-turn_b_in';
                $turn_b_out = $i . '-turn_b_out';

                // Vamos a asignar los valores a las variables en formato de hora. 
                // Si no está declarado asignaremos el valor por defecto
                $time_a_in = (!is_null($request->$turn_a_in)) ? strtotime($request->$turn_a_in) : $default_a_in;
                $time_a_out = (!is_null($request->$turn_a_out)) ? strtotime($request->$turn_a_out) : $default_a_out;
                $time_b_in = (!is_null($request->$turn_b_in)) ? strtotime($request->$turn_b_in) : $default_b_in;
                $time_b_out = (!is_null($request->$turn_b_out)) ? strtotime($request->$turn_b_out) : $default_b_out;

                // Ahora debemos validar los rangos de fechas
                $validation_1 = ($time_a_in < $time_a_out) ? true : false;
                $validation_2 = ($time_a_out > $time_a_in && $time_a_out < $time_b_in) ? true : false;
                $validation_3 = ($time_b_in > $time_a_out && $time_b_in < $time_b_out) ? true: false;
                $validation_4 = ($time_b_out > $time_b_in) ? true : false;

                //validación general
                $general_validaion = ($validation_1 && $validation_2 && $validation_3 && $validation_4);

                // En caso de ser verdadera la validación general, debemos almacenar los valores, en caso contrario , si hay un error se almacena el mensaje y se almacenan los valores 
                if ($general_validaion) {
                    $value += [
                        $i => [
                            'a_in_H' => date('H', $time_a_in), 
                            'a_in_i' => date('i', $time_a_in),
                            'a_out_H' => date('H', $time_a_out),
                            'a_out_i' => date('i', $time_a_out),
                            'b_in_H' => date('H', $time_b_in), 
                            'b_in_i' => date('i', $time_b_in),
                            'b_out_H' => date('H', $time_b_out),
                            'b_out_i' => date('i', $time_b_out),
                        ],
                    ];
                } else {
                    $value += [
                        $i => [
                            'a_in_H' => date('H', $default_a_in), 
                            'a_in_i' => date('i', $default_a_in),
                            'a_out_H' => date('H', $default_a_out),
                            'a_out_i' => date('i', $default_a_out),
                            'b_in_H' => date('H', $default_b_in), 
                            'b_in_i' => date('i', $default_b_in),
                            'b_out_H' => date('H', $default_b_out),
                            'b_out_i' => date('i', $default_b_out),
                        ],
                    ];
                }
            }
        }

        // Almacenar la información en formato Json
        $json = json_encode($value);

        DisableTime::updateOrCreate([
            'user_id' => $user->id,
            'key' => 'hours',
        ],[
            'value' => $json
        ]);

        return '';
    }
}
