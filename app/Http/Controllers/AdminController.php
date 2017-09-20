<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;

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

    public function storeUser(Request $request)
    {
        $user = new User();
        $user->create($request);
        return redirect()->route('admin');
    }
}
