<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        switch (\Auth::user()->role->code)
        {
            case \App\Role::ROLE_ADMINISTRATOR:
                if($request->session()->get('alert-error')){
                    $request->session()->flash('alert-error', $request->session()->get('alert-error'));
                }
                return redirect()->route('admin');
            case \App\Role::ROLE_MANAGER:

                if($request->session()->get('alert-error')){
                    $request->session()->flash('alert-error', $request->session()->get('alert-error'));
                }
                return redirect()->route('manager');
            case \App\Role::ROLE_CUSTOMER:

                if($request->session()->get('alert-error')){
                    $request->session()->flash('alert-error', $request->session()->get('alert-error'));
                }
                return redirect()->route('customer');
            case \App\Role::ROLE_DRIVER:

                if($request->session()->get('alert-error')){
                    $request->session()->flash('alert-error', $request->session()->get('alert-error'));
                }
                return redirect()->route('driver');
            default:

                if($request->session()->get('alert-error')){
                    $request->session()->flash('alert-error', $request->session()->get('alert-error'));
                }
                return redirect()->route('logout');
        }
    }
}
