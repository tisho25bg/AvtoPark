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
		$vehicleTypes	 = \App\Vehicle_types::get();
		$vehicleStatuses = \App\Status::get();
		return view('manager.pages.create-vehicle')
				->with('vehicleTypes', $vehicleTypes)
				->with('vehicleStatuses', $vehicleStatuses);
	}

	public function storeVehicle(VehicleFormRequest $request)
	{
		$vehicle = new Vehicles();
		$vehicle->create($request);

		$request->session()->flash('alert-success', 'Успешно добавихте превозното средство!');
		return redirect()->route('show-vehicles');
	}

	public function showVehicles()
	{
		$vehicles = Vehicles::all();

		return view('manager.pages.vehicles')->with('vehicles', $vehicles);
	}

	public function maps()
	{
		return view('manager.pages.maps');
	}

	public function deleteVehicle($id, Request $request)
	{
		Vehicles::find($id)->delete();

		$request->session()->flash('alert-success', 'Успешно изтрихте превозно средство!');
		return redirect()->route('show-vehicles');
	}

	public function editVehicle($id)
	{
		$vehicle		 = Vehicles::find($id);
		$vehicleTypes	 = \App\Vehicle_types::get();
		$vehicleStatuses = \App\Status::get();
		return view('manager.pages.edit-vehicle')
				->with('vehicle', $vehicle)
				->with('vehicleTypes', $vehicleTypes)
				->with('vehicleStatuses', $vehicleStatuses);
	}

	public function saveVehicle($id, VehicleFormRequest $request)
	{
		$vehicle = Vehicles::find($id);
		foreach ($request->all() as $k => $v)
		{
			if (isset($vehicle->$k))
			{
				$vehicle->$k = $v;
			}
		}
		$vehicle->save();

		$vehicleTypes	 = \App\Vehicle_types::get();
		$vehicleStatuses = \App\Status::get();

		$request->session()->flash('alert-success', 'Успешно редактирахте превозно средство!');
		return view('manager.pages.edit-vehicle')
				->with('vehicle', $vehicle)
				->with('vehicleTypes', $vehicleTypes)
				->with('vehicleStatuses', $vehicleStatuses);
	}

}
