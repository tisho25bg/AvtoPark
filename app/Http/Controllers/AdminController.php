<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
	public function index()
	{
		return view('users.admin.layouts.master-admin');
	}
}
