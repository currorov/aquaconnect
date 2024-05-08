<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jetsky
 * 
 * @property int $id
 * @property string $model
 * @property Carbon $date
 * @property int $hours
 * @property string $brand
 * @property string $matricula
 * @property string $description
 * @property string $image
 * @property int $user_id
 *
 * @package App\Models
 */
class Jetsky extends Model
{
	protected $table = 'jetsky';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'hours' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'model',
		'date',
		'hours',
		'brand',
		'matricula',
		'description',
		'image',
		'user_id'
	];
}
