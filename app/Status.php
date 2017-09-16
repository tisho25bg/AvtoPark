<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'vehicle_status';
    protected $primaryKey = 'id';

    public function vehicles(){
        return $this->hasMany('App\Vehicles', 'status_id', 'id');
    }
}
