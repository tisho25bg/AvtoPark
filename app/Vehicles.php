<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'id';

    public function status(){
        return $this->hasOne('App\Status', 'id', 'status_id');
    }

    public function vehicle_types(){
        return $this->hasOne('App\Vehicle_types', 'id', 'status_id');
    }
}
