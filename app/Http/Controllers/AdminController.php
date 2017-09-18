<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function index()
	{
		return view('admin.pages.index');
	}

	public function createUser()
    {
        return view('admin.pages.create-user');
    }

    public function storeUser(Request $request)
    {

    }
}
