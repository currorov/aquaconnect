<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property int $age
 * @property string|null $image
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'user';
	public $timestamps = false;

	protected $casts = [
		'age' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'name',
		'surname',
		'email',
		'age',
		'image'
	];
}
