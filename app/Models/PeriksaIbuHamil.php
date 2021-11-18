<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PeriksaIbuHamil
 * 
 * @property int $id
 * @property int $pemeriksaan_id
 * @property float $berat_badan
 * @property float $tekanan_darah
 * @property int $bulan_kehamilan
 * @property float $tinggi_fundus
 * @property float $denyut_jantung_janin
 * @property float $lingkar_lengan_atas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Pemeriksaan $pemeriksaan
 *
 * @package App\Models
 */
class PeriksaIbuHamil extends Model
{
	protected $table = 'periksa_ibu_hamils';

	protected $casts = [
		'pemeriksaan_id' => 'int',
		'berat_badan' => 'float',
		'tekanan_darah' => 'float',
		'bulan_kehamilan' => 'int',
		'tinggi_fundus' => 'float',
		'denyut_jantung_janin' => 'float',
		'lingkar_lengan_atas' => 'float'
	];

	protected $fillable = [
		'pemeriksaan_id',
		'berat_badan',
		'tekanan_darah',
		'bulan_kehamilan',
		'tinggi_fundus',
		'denyut_jantung_janin',
		'lingkar_lengan_atas'
	];

	public function pemeriksaan()
	{
		return $this->belongsTo(Pemeriksaan::class);
	}
}
