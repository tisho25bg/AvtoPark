<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    //връзка много->1 с таблица users
    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
