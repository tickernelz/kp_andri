<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Imunisasi
 * 
 * @property int $id
 * @property string $nama
 * @property string|null $kegunaan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PeriksaBalita[] $periksa_balitas
 *
 * @package App\Models
 */
class Imunisasi extends Model
{
	protected $table = 'imunisasis';

	protected $fillable = [
		'nama',
		'kegunaan'
	];

	public function periksa_balitas()
	{
		return $this->hasMany(PeriksaBalita::class);
	}
}
