<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug','description',
    ];
    public function permissions(){
        return $this->hasMany(Permission::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function store($request){
        $slug = Str::of($request->name)->slug('-');
        return self::create($request->all() + [
            'slug' => $slug, 
        ]);
    }
    public function my_update($request){
        $slug = Str::of($request->name)->slug('-');
        self::update($request->all() + [
            'slug' => $slug, 
        ]);
    }
}
