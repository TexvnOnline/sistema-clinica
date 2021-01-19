<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'name',
    ];
    //RELACIONES
    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    //ALMACENAMIENTO
    public function store($request){
        return self::create($request->all());
    }
    public function my_update($request){
        return self::update($request->all());
    }
}
