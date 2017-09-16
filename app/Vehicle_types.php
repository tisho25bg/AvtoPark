<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_types extends Model
{
    protected $table = 'vehicle_types';
    protected $primaryKey = 'id';

    public function vehicles(){
        return $this->hasMany('App\Vehicles', 'status_id', 'id');
    }
}
