<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 * 
 * @property int $mp_id
 * @property string $mp_user_details_id
 * @property string|null $mp_passkey
 * @property string $mp_availability
 * @property string $mp_block_data
 * @property string $mp_name
 * @property string $mp_meta
 * @property string $mp_author
 *
 * @package App\Models
 */
class Map extends Model
{
	protected $table = 'maps';
	protected $primaryKey = 'mp_id';
	public $timestamps = false;

	protected $fillable = [
		'mp_user_details_id',
		'mp_passkey',
		'mp_availability',
		'mp_block_data',
		'mp_name',
		'mp_meta',
		'mp_author'
	];
}
