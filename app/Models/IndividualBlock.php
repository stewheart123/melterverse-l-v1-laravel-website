<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IndividualBlock
 * 
 * @property string $ib_id
 * @property string $ib_production_name
 * @property string $ib_display_name
 * @property string $ib_location
 * @property string $ib_file_array
 * @property string $ib_author
 * @property string $ib_meta
 *
 * @package App\Models
 */
class IndividualBlock extends Model
{
	protected $table = 'individual_blocks';
	protected $primaryKey = 'ib_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'ib_production_name',
		'ib_display_name',
		'ib_location',
		'ib_file_array',
		'ib_author',
		'ib_meta'
	];
}
