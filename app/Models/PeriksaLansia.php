<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PeriksaLansia
 * 
 * @property int $id
 * @property int $pemeriksaan_id
 * @property float $berat_badan
 * @property float $tekanan_darah
 * @property float $gula_darah
 * @property float $kolesterol
 * @property float $asam_urat
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Pemeriksaan $pemeriksaan
 *
 * @package App\Models
 */
class PeriksaLansia extends Model
{
	protected $table = 'periksa_lansias';

	protected $casts = [
		'pemeriksaan_id' => 'int',
		'berat_badan' => 'float',
		'tekanan_darah' => 'float',
		'gula_darah' => 'float',
		'kolesterol' => 'float',
		'asam_urat' => 'float'
	];

	protected $fillable = [
		'pemeriksaan_id',
		'berat_badan',
		'tekanan_darah',
		'gula_darah',
		'kolesterol',
		'asam_urat'
	];

	public function pemeriksaan()
	{
		return $this->belongsTo(Pemeriksaan::class);
	}
}
