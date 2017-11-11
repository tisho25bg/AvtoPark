<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\ShareFormRequest;

class AdminController extends Controller
{

	public function index()
	{
		return view('admin.pages.index');
	}

	public function users()
	{
		$users = User::all();
		return view('admin.pages.users')->with('users', $users);
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
		$user->store($request);
		return redirect()->route('users');
	}

	public function deleteUser($id)
	{
		User::find($id)->delete();
		return redirect()->route('users');
	}

	public function editUser($id)
	{
		$user	 = User::find($id);
		$roles	 = \App\Role::all();
		return view('admin.pages.edit-user')
				->with('user', $user)
				->with('roles', $roles);
	}

	public function saveUser($id, ShareFormRequest $request)
	{
		$user = User::find($id);
		foreach ($request->all() as $k => $v)
		{
			if (isset($user->$k))
			{
				$user->$k = $v;
			}
		}
		$user->save();

		$roles = \App\Role::all();
		return view('admin.pages.edit-user')
				->with('user', $user)
				->with('roles', $roles);
	}

}
