<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDetail
 * 
 * @property string $ud_id
 * @property string $ud_packs_purchased
 * @property string $ud_editor_session_key
 * @property string $ud_additional
 * @property string $ud_wallet
 * @property string $ud_map_collection
 * @property string $ud_friends_list
 * @property string|null $ud_linking_id
 *
 * @package App\Models
 */
class UserDetail extends Model
{
	protected $table = 'user_details';
	protected $primaryKey = 'ud_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'ud_packs_purchased',
		'ud_editor_session_key',
		'ud_additional',
		'ud_wallet',
		'ud_map_collection',
		'ud_friends_list',
		'ud_linking_id'
	];
}
