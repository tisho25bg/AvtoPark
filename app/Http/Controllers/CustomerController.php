<?php

namespace App\Http\Controllers;

use App\Orders;
use App\OrderStatus;
use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{

	public function index()
	{
		return view('customer.pages.index');
	}

	public function createOrder()
    {
        $services = \App\Services::get();
        return view('customer.pages.create-order')
                    ->with('services', $services);
    }

    public function storeOrder(Request $request){
	    $order = new Orders();
	    $order->createForCustomer($request);
//        $orderPrice     = $order->calculatePriceOfOrder($order->id);
//        $order->price   = $orderPrice;
       // $order->save();
      //  dd($order->orderStatus->code);
	    return redirect()->route('customer-orders');
    }

//    public function calculateOrder($id)
//    {
//        $order = Orders::find($id);
//
//        $orderPrice     = $order->calculatePriceOfOrder($order->id);
//        $order->price   = $orderPrice;
//      //  $order->save();
//        return view('customer.pages.customer-orders')
//                    ->with('order', $order)
//                    ->with('orderPrice', $orderPrice);
//
//    }

    public function showCustomerOrders()
    {
        $customer = Auth::user();
        //$closedId = OrderStatus::where('type', '=', OrderStatus::ORDER_STATUS_CLOSED);
        $orders   = Orders::where('customer_id', '=', $customer->id)->get();
        return view('customer.pages.customer-orders')
                    ->with('orders', $orders);

    }
}
