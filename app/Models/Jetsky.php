<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Jetsky
 * 
 * @property int $id
 * @property string $model
 * @property string $brand
 * @property string $description
 * @property int $user_id
 *
 * @package App\Models
 */
class Jetsky extends Model
{
	protected $table = 'jetsky';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'model',
		'brand',
		'description',
		'user_id'
	];
}
