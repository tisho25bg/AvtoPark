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
		$roles = \App\Role::all();
		return view('admin.pages.create-user')
				->with('roles', $roles);
	}

	public function storeUser(ShareFormRequest $request)
	{

		$user = new User();
		$user->store($request);

		$request->session()->flash('alert-success', 'Успешно добавихте потребител!');
		return redirect()->route('users');
	}

	public function deleteUser($id, \Illuminate\Http\Request $request)
	{
		User::find($id)->delete();

		$request->session()->flash('alert-success', 'Успешно изтрихте потребител!');
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
			if (in_array($k, $user->getFillable()))
			{
				$user->$k = $v;
			}
		}
        if($user->role->code != 'DRIVER' ){
            $user->driveLicenseCategory =  '';
            $user->driveLicenseExpired =  null;
        }
        $user->save();

		$roles = \App\Role::all();

		$request->session()->flash('alert-success', 'Успешно редактирахте потребител!');
		return view('admin.pages.edit-user')
				->with('user', $user)
				->with('roles', $roles);
	}

}
