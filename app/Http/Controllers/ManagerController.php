<?php

namespace App\Http\Controllers;

use App\LogVehicles;
use App\OrderStatus;
use App\User;
use App\VehicleRepair;
use Illuminate\Http\Request;
use App\Vehicles;
use App\Http\Requests\VehicleFormRequest;
use App\Orders;
use App\Status;
use App\Role;
use App\VehicleReservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrdersFormRequest;

class ManagerController extends Controller
{

	public function index(Request $request)
	{
		return view('manager.pages.index');
	}

	public function createVehicle()
	{
        $vehicleStatuses = \App\Status::get();
        $vehicleTypes	 = \App\Vehicle_types::get();

        return view('manager.pages.create-vehicle')
				->with('vehicleTypes', $vehicleTypes)
				->with('vehicleStatuses', $vehicleStatuses);
	}

	public function storeVehicle(VehicleFormRequest $request)
	{
        $vehicle = new Vehicles();

        $vehicle->create($request);

        $logVehicle = new LogVehicles();

        $logVehicle->vehicle_id = $vehicle->id;
        $logVehicle->message = 'Добавяне на ново МПС';
        $logVehicle->date = \Carbon\Carbon::now();
        $logVehicle->save();

//
//        $timestamp = strtotime($vehicleInsurance);
//        $now = strtotime('NOW');
//        $timeToExpired= idate('d', ($timestamp - $now ));
//
//        if($timeToExpired <=0)
//        {
//            $request->session()->flash('alert-danger', 'Моля въведете коректна дата!!!');
//            return redirect()->route('create-vehicle');
//        }else
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
        $logVehicle = new LogVehicles();
        $logVehicle->vehicle_id = Vehicles::find($id)->id;
        $logVehicle->message = 'Бракуване на  МПС';
        $logVehicle->date = \Carbon\Carbon::now();
        $logVehicle->save();

        Vehicles::find($id)->delete();
        $request->session()->flash('alert-success', 'Успешно изтрихте превозно средство!');
		return redirect()->route('show-vehicles');
	}

	public function editVehicle($id)
	{
		$vehicle		 = Vehicles::find($id);
		$vehicleTypes	 = \App\Vehicle_types::get();
		$vehicleStatuses = \App\Status::get();
        $brokenVehicle   = new VehicleRepair();
        $oldStatus       = $vehicle->status_id;
        /*
                Така ще се взима времето и ще се сравняват датите :
             * $nowInSofia = Carbon::now('Europe/Sofia');
            $logTime = new \DateTime($log->date);
            $diff = $nowInSofia->diff($logTime);
            dd($diff->days +1);
         */


        $vehicleRepairData = array(
            'dateInRepair'   => '',
            'serviceName'    => '',
            'repairType'     => '',
            'dateOutRepair'  => '',
            'price'          => '',
        );
        $vehicleRepair = $vehicle->vehicleRepair()->whereNull('dateOutRepair')->first();

        if($vehicleRepair != null){
            $vehicleRepairData = array(
                'dateInRepair'   => $vehicleRepair->dateInRepair,
                'serviceName'    => $vehicleRepair->serviceName,
                'repairType'     => $vehicleRepair->repairType,
                'dateOutRepair'  => $vehicleRepair->dateOutRepair,
                'price'          => $vehicleRepair->price,
            );

        }


		return view('manager.pages.edit-vehicle')
				->with('vehicle', $vehicle)
				->with('vehicleTypes', $vehicleTypes)
				->with('vehicleStatuses', $vehicleStatuses)
                ->with('brokenVehicle', $brokenVehicle)
                ->with('oldStatus', $oldStatus)
                ->with('vehicleRepairData', $vehicleRepairData);
	}
	public function saveVehicle($id, Request $request)
    {
        $vehicle = Vehicles::find($id);

        $logVehicle = new LogVehicles();

        if($vehicle->vehicleRepair()->whereNull('dateOutRepair')->first() == null){

            $newStatusCode = Status::find($request->get('vehicle_status_id'))->type;

            if($newStatusCode== Status::STATUS_ON_REPAIR){

                $brokenVehicle = new VehicleRepair();
                $brokenVehicle->create($request);

                $logVehicle->vehicle_id = Vehicles::find($id)->id;
                $logVehicle->message = 'Изпращане на МПС в сервиз ' . $brokenVehicle->serviceName;
                $logVehicle->date = \Carbon\Carbon::now();
                $logVehicle->save();
            }


        }else{
            $brokenVehicle = VehicleRepair::find($vehicle->vehicleRepair->id);
            foreach ($request->all() as $k => $v)
            {
                if (isset($brokenVehicle->$k))
                {
                    $brokenVehicle->$k = $v;
                }
            }
            $brokenVehicle->save();
        }

        $logOtremontirane  = false;
        //1.вземаш стариа статус от $vehicle
        $oldStatus = $vehicle->status;
        if($oldStatus->type == Status::STATUS_ON_REPAIR){
            //2.вземаш новия статус от $request
            $newStatusId = $request->get('vehicle_status_id');
            //3. ако са различни
            if ($oldStatus->id != $newStatusId) {
                $newStatus = Status::find($newStatusId);
                //3.1. ако новия статус е различен от OnRepair
                if($newStatus != Status::STATUS_ON_REPAIR){
                    //3.1.1 сложи дата тука:
                    $vehicleRepair = $vehicle->vehicleRepair()->whereNull('dateOutRepair')->first();
                    $vehicleRepair->dateOutRepair = $request->get('dateOutRepair');
                    //3.1.2 запиши
                    $vehicleRepair->save();
                    $logOtremontirane = true;
                    $logVehicle->vehicle_id = Vehicles::find($id)->id;
                    $logVehicle->message = 'Oтремонтиране на МПС -'. $vehicle->brand. ' - ' .$vehicle->regNumber. ' от сервиз ' . $vehicleRepair->serviceName;
                    $logVehicle->date = \Carbon\Carbon::now();
                    $logVehicle->save();
                }
            }
        }
//
//        $order = Orders::find($id);
//        foreach ($order->getAttributes() as $k=>$v)
//        {
//            if(isset($request->$k))
//            {
//                $order->$k = $request->$k;
//            }
//        }
//

        foreach ($vehicle->getAttributes() as $k => $v)
		{
			if (isset($request->$k))
			{
				$vehicle->$k = $request->$k;
			}
		}
		$vehicle->save();

		$request->session()->flash('alert-success', 'Успешно редактирахте превозно средство!');
        return redirect()->route('edit-vehicle', ['id' => $id]);
	}

	public function vehicleProfile($id)
    {
        $vehicle = Vehicles::findOrFail($id);

        $brokenVehicles = $vehicle->logVehicles()->orderBy('created_at', 'desc')->get();

        return view('manager.pages.vehicle-profile')
            ->with('vehicle', $vehicle)
            ->with('brokenVehicles', $brokenVehicles);
    }

    public function vehicleRepairProfile($id)
    {
        $vehicle = Vehicles::findOrFail($id);
        $brokenVehicles = $vehicle->vehicleRepair()->orderBy('created_at', 'desc')->get();
        return view('manager.pages.vehicle-repair-profile')
            ->with('vehicle', $vehicle)
            ->with('brokenVehicles', $brokenVehicles);
    }

    public function showOrders()
    {
        return view('manager.pages.orders.orders')->with('orders', Orders::all());
    }
	public function createOrder()
    {

        $drivers = User::query()
            ->join('roles', 'roles.id', '=', 'role_id')
            ->leftJoin('orders', 'driver_id', '=', 'users.id')
            ->whereNull('orders.id')
//            ->Where('order_status_id', '<>',
//                $closedOrderId = OrderStatus::where('type', '=', OrderStatus::ORDER_STATUS_CLOSED)->first()->id3)
            ->where('roles.code', '=', Role::ROLE_DRIVER)
            ->get(['users.*']);

        $services           = \App\Services::get();
        $vehicles           = \App\Vehicles::get();
        $managers           = \App\User::get();
        $orderStatus        = \App\OrderStatus::get();
        $vehicleReservation = \App\VehicleReservation::get();
        $customers = User::whereHas('role', function ($query) {
            $query->where('code', '=', Role::ROLE_CUSTOMER);
        })->get();


        $freeVehicles = Vehicles::whereHas('status', function ($query) {
            $query->where('type', '=', Status::STATUS_FREE);
        })->get();

//        $vehiclesOnRepair = Vehicles::whereHas('status', function ($query) {
//            $query->where('type', '=', Status::STATUS_ON_REPAIR);
//        })->get();

//        dd($vehiclesOnRepair, $freeVehicles);
        return view('manager.pages.orders.create-order')
            ->with('services', $services)
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers)
            ->with('managers', $managers)
            ->with('customers', $customers)
            ->with('orderStatus', $orderStatus)
            ->with('freeVehicles', $freeVehicles)
            ->with('vehicleReservation', $vehicleReservation);
    }

    public function storeOrder( OrdersFormRequest $request)
    {
        $order = new Orders();
        $order->create($request);
        $vehicleReservation = new VehicleReservation();
//        $orderPrice     = json_decode($order->calculatePriceOfOrder($order->id));
//
//        $order->price   = $orderPrice;
//
//        $order->save();
      //  dd($orderPrice, $order->id);
        $vehicleID                      = $order->vehicle_id;
        $vehicle                        = Vehicles::find($vehicleID);
        $vehicle->vehicle_status_id     = 4;
        $vehicle->mileage              += $order->kilometres;
        $vehicle->save();

        $vehicleReservation->order_id   = $order->id;
        $timeTest                       = $order->orderDate;
        $carbon_date                    = Carbon::parse($timeTest);
        $carbon_date2                   = $carbon_date->addHours($order->timeToArrive );
        //2018-01-09 17:00:00.000000
        /*Добавям времето за пристигане, което е 440 минути :
            и се получава :
        2018-01-09 22:00:00.000000
            2018-01-23 22:00:00.000000
         * */
        //2018-01-16 21:43:00.000000

        $vehicleReservation->orderStartDate = Carbon::parse($order->orderDate);
        $vehicleReservation->orderEndDate   = $vehicleReservation->orderStartDate->addHour($order->timeToArrive);
        $vehicleReservation->create($request);
//dd($vehicleReservation->orderEndDate);
        //dd($timeTest, $carbon_date, $carbon_date2, $order->timeToArrive );
//dd($orderPrice);

        $request->session()->flash('alert-success', 'Успешно добавихте Поръчка!');

        return redirect()->route('show-orders');
    }



    public function editOrder($id)
    {
        $order = Orders::find($id);
        $services = \App\Services::get();
        $vehicles  = \App\Vehicles::get();
        $managers  = \App\User::get();
        $vehicleReservation =  \App\VehicleReservation::get();
        $vehicleReservation->order_id   = $order->id;
        $timeTest                       = $order->orderDate;
        $carbon_date                    = Carbon::parse($timeTest);
        $carbon_date2                   = $carbon_date->addHours($order->timeToArrive );
        //2018-01-09 17:00:00.000000
        /*Добавям времето за пристигане, което е 440 минути :
            и се получава :
        2018-01-09 22:00:00.000000
            2018-01-23 22:00:00.000000
         * */
        //2018-01-16 21:43:00.000000

        $vehicleReservation->orderStartDate = Carbon::parse($order->orderDate);
        $vehicleReservation->orderEndDate   = $vehicleReservation->orderStartDate->addHour($order->timeToArrive);
//        $vehicleReservation->save();
     //   dd($vehicleReservation);
        $customers  = User::whereHas('role', function ($query) {
            $query->where('code', '=', Role::ROLE_CUSTOMER);
        })->get();


        $freeVehicles = Vehicles::whereHas('status', function ($query) {
            $query->where('type', '=', Status::STATUS_FREE);
        })->get();

        $drivers = User::whereHas('role', function ($query) {
            $query->where('code', '=', Role::ROLE_DRIVER);
        })->get();
        return view('manager.pages.orders.edit-order')
            ->with('order', $order)
            ->with('services', $services)
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers)
            ->with('managers', $managers)
            ->with('customers', $customers)
            ->with('freeVehicles', $freeVehicles)
            ->with('vehicleReservation', $vehicleReservation);
    }

    public function saveOrder($id, Request $request)
    {
        $order      = Orders::find($id);

        //dd($vehicleId, $order, $vehicle);
        foreach ($order->getAttributes() as $k=>$v)
        {
            if(isset($request->$k))
            {
                $order->$k = $request->$k;
            }
        }

        //ако поръчката не е вързана към мениджър
        if($order->manager == null){
            //свържи го със този който записва промените
            $order->manager_id = Auth::user()->id;
            //сложи статуса да е обработва се
            $order->order_status_id = OrderStatus::where('type', '=', OrderStatus::ORDER_STATUS_PROCESSING)->first()->id;

        }

        $order->save();



        $request->session()->flash('alert-success', 'Успешно редактирахте поръчка!');
        return redirect()->route('edit-order', ['id' => $id]);
    }

    public function deleteOrder($id, Request $request)
    {

        $order = Orders::find($id);


        $vehicleID = $order->vehicle_id;

        $vehicle = Vehicles::find($vehicleID);

        $vehicle->vehicle_status_id = 1;

        $vehicle->save();

        $order->driver_id = NULL;
        $order->delete();

        $request->session()->flash('alert-success', 'Успешно изтрихте услуга!');

        return redirect()->route('show-orders');
    }

    public function newOrderFromCustomer()
    {
        $closedId =  OrderStatus::where('type', '=', OrderStatus::ORDER_STATUS_CLOSED)->first()->id;
        $orders = Orders::where('order_status_id', '<>', $closedId)->get();
        return view('manager.pages.orders.new-orders')
                    ->with('orders', $orders);
    }

    public function storeOrderFromCustomer(Request $request)
    {

    }

}
