<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * 
 * @property int $id
 * @property string $title
 * @property string $location
 * @property Carbon $date
 * @property Carbon $time
 * @property string $desc_location
 * @property string $desc_event
 * @property int $personas_apuntadas
 * @property int $id_user
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'time' => 'datetime',
		'personas_apuntadas' => 'int',
		'id_user' => 'int'
	];

	protected $fillable = [
		'title',
		'location',
		'date',
		'time',
		'desc_location',
		'desc_event',
		'personas_apuntadas',
		'id_user'
	];
}
