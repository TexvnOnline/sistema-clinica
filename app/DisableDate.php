<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisableDate extends Model
{
    protected $fillable = [
        'key', 'value', 'user_id',
    ];

    // RELACIONES
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    // METODOS PARA ALMACENAR

    

    public function process_disabled_dates($dates)
    {
        //Convertimos en un arreglo las fechas
        $dates = explode(',', $dates);
        //Declaramos la variable new_dates para almacenar las fechas procesadas.
        $str_dates = '';
        // Para el plugin de pickadate es necesario reducir una unidad cada mes para que corresponda con la selección del usuario
        foreach ($dates as $key => $date) {
            $date = trim($date);
            $date_elements = explode('/', $date);
            $year = $date_elements[0];
            $month = $date_elements[1];
            $day = $date_elements[2];
            $new_date = $year . ',' . ($month - 1) . ',' . $day;
            $str_dates .= $new_date . '-';
        }
        //Eliminamos el último caracter de la cadena
        $str_dates = substr($str_dates, 0, -1);
        return $str_dates;
    }
}
