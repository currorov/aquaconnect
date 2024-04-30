<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersEvent
 * 
 * @property int $id
 * @property int $id_event
 * @property int $id_user
 *
 * @package App\Models
 */
class UsersEvent extends Model
{
	protected $table = 'users_events';
	public $timestamps = false;

	protected $casts = [
		'id_event' => 'int',
		'id_user' => 'int'
	];

	protected $fillable = [
		'id_event',
		'id_user'
	];
}
