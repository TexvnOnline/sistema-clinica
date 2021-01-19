<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicData extends Model
{
    protected $fillable = [
        'key', 'value', 'user_id', 'created_by', 'updated_by'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function creator(){
        return $this->belongsTo('App\User', 'created_by');
    }
    public function updater(){
        return $this->belongsTo('App\User', 'updated_by');
    }

    //ALMACENAMIENTO
    public function store($request, $user){
        #variables
        $values = $request->all();
        unset($values['_token']);
        $created_by = $request->user()->id;
        $updated_by = $request->user()->id;

        #Almacenamiento recursivo
        $this->recursive_storage($values, $user, $created_by, $updated_by);
    }

    // Perimer vamos a recorrer cada uno de los valores
    // En seguida vamos a verificar que la clave pertenezca a alguno de los valores autorizados en el archivo key_config
    // Después veifica si se trata de una actualización de una creación de registro.

    public function recursive_storage($values, $user, $created_by, $updated_by){
        foreach ($values as $key => $value) {
            //Varificar valores autorizados
            $authorized_values = config('key_clinic');
            if(in_array($key, $authorized_values)){
                //Determinar si el valor existe
                $data = $user->clinic_datas()->where('key', $key)->first();
                if(is_null($data)){
                    //Creación
                    self::create([
                        'key' => $key,
                        'value' => $value,
                        'user_id' => $user->id,
                        'created_by' => $created_by,
                        'updated_by' => $updated_by
                    ]);
                }else{
                    //Actualización
                    $data->update([
                        'key' => $key,
                        'value' => $value,
                        'user_id' => $user->id,
                        'updated_by' => $updated_by
                    ]);
                }
            }
        }
    }
}
