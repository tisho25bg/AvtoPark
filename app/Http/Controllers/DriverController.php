<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\LogVehicles;
use App\Orders;
use App\OrderStatus;
use App\Status;
use App\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{

	public function index()
	{

        $driver      = Auth::user();
        $closedId =  OrderStatus::where('type', '=', OrderStatus::ORDER_STATUS_CLOSED)->first()->id;
        $orders = Orders::where('driver_id', '=', $driver->id)
            ->where('order_status_id', '<>', $closedId)
            ->get();
		return view('driver.pages.index')
            ->with('orders', $orders);
	}

	public function startOrder(Request $request)
    {
        $logVehicle = new LogVehicles();

        $order = Orders::find($request->orderId);
        $order->order_status_id = OrderStatus::where('type', '=', OrderStatus::ORDER_STATUS_SENT)->first()->id;
        $order->save();

        $vehicle = Vehicles::find($order->vehicle_id);
        $vehicle->vehicle_status_id = 2;

        $vehicle->mileage += $order->kilometres;
        $vehicle->save();
        $request->session()->flash('alert-success', 'Успешно приехте поръчка!');

        $message= 'Изпращане на МПС на път '  . ' ' . $order->services->name . ' Шофьор : '
            . ' ' . $order->driver->fullName . ' Разстояние '
            . ' ' . $order->kilometres;

        //dd($vehicle->id);
        //$logVehicle->create($vehicle->vehicle_id, $message);
        $logVehicle->create($vehicle->id, $message);
        return redirect()->route('driver');
    }
    public function endOrder(Request $request)
    {

        $logVehicle = new LogVehicles();
        $order = Orders::find($request->orderId);
        $order->order_status_id = OrderStatus::where('type', '=', OrderStatus::ORDER_STATUS_CLOSED)->first()->id;


        $vehicle = Vehicles::find($order->vehicle_id);
        $vehicle->vehicle_status_id = 1;
        $vehicle->save();
        $message= 'Връщане на МПС на път '  . ' ' . $order->services->name . ' Шофьор : '
            . ' ' . $order->driver->fullName . ' Разстояние '
            . ' ' . $order->kilometres;

        //dd($vehicle->id);
        //$logVehicle->create($vehicle->vehicle_id, $message);
        $logVehicle->create($vehicle->id, $message);
        $order->driver_id = NULL;

        $order->save();
        $request->session()->flash('alert-success', 'Успешно приключихте поръчка!');



        return redirect()->route('driver');
    }
}
