<?php

namespace App\Http\Controllers;


use App\Vehicles;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ShareFormRequest;
use App\Http\Requests\VehicleFormRequest;

class AdminController extends Controller
{
	public function index()
	{
		return view('admin.pages.index');
	}

	public function createUser()
    {
        $roles = \App\Role::where('code', '!=', \App\Role::ROLE_ADMINISTRATOR)->get();
        return view('admin.pages.create-user')
            ->with('roles', $roles);
    }

    public function storeUser(ShareFormRequest $request)
    {

        $user = new User();
        $user->create($request);
        return redirect()->route('admin');
    }


    public function createVehicle()
    {
        $vehicleTypes   = \App\Vehicle_types::get();
        $vehicleStatuses = \App\Status::get();
        return view('admin.pages.create-vehicle')
            ->with('vehicleTypes', $vehicleTypes)
            ->with('vehicleStatuses', $vehicleStatuses);
    }

    public function storeVehicle(VehicleFormRequest $request)
    {
        $vehicle = new Vehicles();
        $vehicle->create($request);
        return redirect()->route('admin')->with('success', 'Успешно добавихте превозното средство!');
    }
}
