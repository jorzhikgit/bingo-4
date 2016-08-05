<?php

use Queue\Repositories\Queue\PassportRepositoryInterface;

class DashboardController extends \BaseController {

	public function __construct(PassportRepositoryInterface $repo)
	{
		$this->repo = $repo;
	}

	public function index()
	{
		$data = [
			"data" => $this->repo->getDashboardInfo()
		];

		return json_encode($data);
	}
	
}