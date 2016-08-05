<?php

class BaseController extends Controller {

	protected $repo;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function getUserId()
	{
		return Auth::user()->id;
	}


	/**
	 * Display a listing of the resource.
	 * GET /repo
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->repo->loadRecord();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /repo
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->repo->saveRecord($this->storeInput());
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /repo/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return $this->repo->saveRecord($this->updateInput(), $id);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /repo/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->repo->deleteRecord($id);
	}

	public function storeInput()
	{
		return Input::all();
	}

	public function updateInput()
	{
		return Input::all();
	}

	public function respondWithError($errors)
	{
		return Response::make($errors, 422);
	}

}
