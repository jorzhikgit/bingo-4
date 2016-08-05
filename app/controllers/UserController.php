<?php

use Queue\Repositories\User\UserRepositoryInterface;

class UserController extends \BaseController {

	public function __construct(UserRepositoryInterface $repo)
	{
		$this->repo = $repo;
	}

	public function profile()
	{
		return $this->repo->getList();
	}

}