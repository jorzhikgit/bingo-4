<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['username', 'password', 'display_name', 'status', 'access_level'];

	public function scopeSortBy($query, $field = 'username')
	{
		return $query->select('id', 'username', 'display_name', 'status', 'access_level')
					 ->orderBy($field);
	}

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public function scopeWithImageLink($query)
	{
		$query->leftJoin('image_links', function($join) {
			$join->on('image_links.table_id', '=', 'users.id');
			$join->on('image_links.table_name', '=', \DB::raw("'user'"));
		});
	}

	public function scopeWithImage($query)
	{
		$query->leftJoin('images', 'images.id', '=', 'image_links.image_id');
	}

}
