<?php

class HomeController extends BaseController {

	public function index()
	{
		$userInfo = Auth::user();

		if (Auth::user()->change_password === 1) return Redirect::route('change.password');

		$environment = App::environment();
		$baseSourcePath = ($environment === 'production' ? 'dist/' : 'src/');

		$dateTime = DB::select('SELECT NOW() AS now');

		JavaScript::put([
			'version' => '0.1.0',
			'baseUrl' => URL::to('/'),
			'token' => csrf_token(),
			'currentDate' => $dateTime[0]->now,
			'environment' => $environment,
			'baseSourcePath' => $baseSourcePath,
			'accessLevel' => Auth::user()->access_level
		]);

		$user = Auth::user();
		$user->picture = $userInfo[0]['picture'];
		$user->pictureLarge = $userInfo[0]['pictureLarge'];

		$paths = ["base_source" => $baseSourcePath];

		return View::make('layout.main')
			->with('user', $user)
			->with('paths', $paths)
			;

	}

}
