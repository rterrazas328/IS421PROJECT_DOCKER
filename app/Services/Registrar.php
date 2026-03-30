<?php namespace App\Services;

use App\User;
use App\UserProfile;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		//print_r($data);
		return Validator::make($data, [
			'honeypot' => 'required|in:IS-421-RRZ',
			'signup-v1-firstname' => 'required|max:32',
			'signup-v1-lastname' => 'required|max:32',
			'signup-v1-username' => 'required|max:100',//unique
			'signup-v1-email' => 'required|confirmed|email|max:100',
			'signup-v1-password' => 'required|confirmed|alphaNum|min:8',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$user = User::create([
			'name' => $data['signup-v1-firstname'],
			'last' => $data['signup-v1-lastname'],
			'user' => $data['signup-v1-username'],
			'email' => $data['signup-v1-email'],
			'password' => bcrypt($data['signup-v1-password']),
			//'remember_token' => $data['remember_token'],
		]);
		$userProfile = new UserProfile;
		$userProfile->id = $user->id;
		$userProfile->save();

		return $user;
	}

}
