<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicles;
use App\Http\Requests\VehicleFormRequest;
class ManagerController extends Controller
{
    public function index(Request $request)
    {
        return view('manager.pages.index');
    }

    public function createVehicle()
    {
        $vehicleTypes   = \App\Vehicle_types::get();
        $vehicleStatuses = \App\Status::get();
        return view('manager.pages.create-vehicle')
            ->with('vehicleTypes', $vehicleTypes)
            ->with('vehicleStatuses', $vehicleStatuses);
    }

    public function storeVehicle(VehicleFormRequest $request)
    {
        $vehicle = new Vehicles();
        $vehicle->create($request);
        return redirect()->route('manager')->with('success', 'Успешно добавихте превозното средство!');
    }

    public function showVehicles()
    {
        $vehicles = Vehicles::all();
//          dd($vehicles->first()->status);

        return view('manager.pages.show-vehicles', compact('vehicles'));
    }

    public function maps()
    {
        return view('manager.pages.maps');
    }
}
