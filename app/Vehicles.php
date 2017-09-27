<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function create(\Illuminate\Http\Request $request)
    {
        $this->brand              =   $request->brand;
        $this->regNumber          =   $request->regNumber;
        $this->fuelType           =   $request->vehicle_engine;
        $this->vehicle_types_id   =   $request->vehicle_type;
        $this->vehicle_status_id  =   $request->vehicle_status;
        $this->fuelConsumption    =   $request->fuelConsumption;
        $this->mileage            =   $request->mileage;
        $this->chargeWeight       =   $request->chargeWeight;
        $this->insurance          =   $request->insurance;
        $this->technicalReview    =   $request->technicalReview;
        $this->save();
    }
}
