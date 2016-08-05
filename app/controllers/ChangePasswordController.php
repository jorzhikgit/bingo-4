<?php

use Queue\Services\Validation\UserValidator;

class ChangePasswordController extends BaseController {

	protected $validator;

	/*public function __construct(UserValidator $validator)
	{
		$this->validator = $validator;
	}*/

	public function postChange()
	{
		$password = Input::all();
		
		/*if ( ! $this->validator->passes($password)) {
			return Redirect::route('change.password')
					->withErrors($this->validator->errors());
		}*/

		$userId = Auth::user()->id;

		$user = User::find($userId);
		$user->password = $password['password'];
		$user->change_password = 0;
		$user->update();

		Auth::logout();

		return Redirect::route('user.login')->with('changed', 1);
	}
}
