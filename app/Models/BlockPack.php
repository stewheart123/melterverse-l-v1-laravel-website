<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BlockPack
 * 
 * @property string $bp_id
 * @property string $bp_production_name
 * @property string $bp_display_name
 * @property string $bp_file_location
 * @property string $bp_genre_ids
 * @property string $bp_availability
 * @property string $bp_description
 * @property string $bp_author_id
 * @property int $bp_total_purchases
 * @property int $bp_total_views
 * @property int $bp_price
 * @property string $bp_pack_contents
 * @property string $bp_additional_currency
 *
 * @package App\Models
 */
class BlockPack extends Model
{
	protected $table = 'block_packs';
	protected $primaryKey = 'bp_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'bp_total_purchases' => 'int',
		'bp_total_views' => 'int',
		'bp_price' => 'int'
	];

	protected $fillable = [
		'bp_production_name',
		'bp_display_name',
		'bp_file_location',
		'bp_genre_ids',
		'bp_availability',
		'bp_description',
		'bp_author_id',
		'bp_total_purchases',
		'bp_total_views',
		'bp_price',
		'bp_pack_contents',
		'bp_additional_currency'
	];
}
