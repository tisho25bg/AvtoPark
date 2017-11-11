<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

	use Notifiable; //?????

	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'egn', 'drive_license', 'role_id',
	];
	protected $haveRole;

	//връзка 1->1 с таблица roles
	public function role()
	{
		return $this->hasOne('App\Role', 'id', 'role_id');
	}

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden	 = [
		'password', 'remember_token',
	];
	protected $dates	 = [
		'drive_license',
	];

	public function store(\Illuminate\Http\Request $request)
	{
		$this->firstName			 = $request->firstName;
		$this->lastName				 = $request->lastName;
		$this->email				 = $request->email;
		$this->password				 = bcrypt($request->password);
		$this->egn					 = $request->egn;
		$this->driveLicenseCategory	 = $request->category;
		$this->driveLicenseExpired	 = $request->expired;
		$this->role_id				 = $request->role_id;
		$this->save();
	}

	public function hasRole($roles)
	{
		$this->haveRole = $this->getUserRole();
		// Check if the user is a root account
		if ($this->haveRole->code == 'ADMIN')
		{
			return true;
		}
		if (is_array($roles))
		{
			foreach ($roles as $need_role)
			{
				if ($this->checkIfUserHasRole($need_role))
				{
					return true;
				}
			}
		}
		else
		{
			return $this->checkIfUserHasRole($roles);
		}
		return false;
	}

	private function getUserRole()
	{
		return $this->role()->getResults();
	}

	private function checkIfUserHasRole($need_role)
	{
		return (strtolower($need_role) == strtolower($this->haveRole->code)) ? true : false;
	}

}
