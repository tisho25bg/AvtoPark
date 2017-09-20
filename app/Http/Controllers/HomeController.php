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
    public function index()
    {
        switch (\Auth::user()->role->code)
        {
            case \App\Role::ROLE_ADMINISTRATOR:
                return redirect()->route('admin');
            case \App\Role::ROLE_MANAGER:
                return redirect()->route('manager');
            case \App\Role::ROLE_CUSTOMER:
                return redirect()->route('customer');
            case \App\Role::ROLE_DRIVER:
                return redirect()->route('driver');
            default:
                return redirect()->route('logout');
        }
    }
}
