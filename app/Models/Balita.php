<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Balita
 * 
 * @property int $id
 * @property int $peserta_id
 * @property string $ayah
 * @property string $ibu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Peserta $peserta
 *
 * @package App\Models
 */
class Balita extends Model
{
	protected $table = 'balitas';

	protected $casts = [
		'peserta_id' => 'int'
	];

	protected $fillable = [
		'peserta_id',
		'ayah',
		'ibu'
	];

	public function peserta()
	{
		return $this->belongsTo(Peserta::class);
	}
}
