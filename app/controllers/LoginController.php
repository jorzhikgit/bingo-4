<?php

use Queue\Services\Validation\UserValidator;

class LoginController extends BaseController {

	protected $validator;

	/*n*/

	public function getLogin()
	{
		return View::make('login');
	}

	public function getLogout()
	{
		Auth::logout();

		return Redirect::route('user.login');
	}

	public function postLogin()
	{
		$user = [
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			'status' => 1
		];

		/*if ( ! $this->validator->passes($user)) {
			return Redirect::route('user.login')
					->withErrors('All Fields are required.')
					->withInput(Input::except('password'));
		}*/

		if (empty($user['username']) || empty($user['password']))
		{
			return Redirect::route('user.login')
					->withErrors('All Fields are required.')
					->withInput(Input::except('password'));
		}

		if (Auth::attempt($user)) {
			return Redirect::intended('/#');
		}

		return Redirect::route('user.login')
			->withErrors('Invalid Credentials!');
	}
}
