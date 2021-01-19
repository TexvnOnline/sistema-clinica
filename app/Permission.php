<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    protected $fillable = [
        'name', 'slug', 'description','role_id'
    ];
    public function role(){
        return $this->belongsTo(Role::class);
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
