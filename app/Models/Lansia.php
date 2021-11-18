<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lansia
 * 
 * @property int $id
 * @property int $peserta_id
 * @property string $golongan_darah
 * @property string $riwayat_penyakit
 * @property string $riwayat_alergi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Peserta $peserta
 *
 * @package App\Models
 */
class Lansia extends Model
{
	protected $table = 'lansias';

	protected $casts = [
		'peserta_id' => 'int'
	];

	protected $fillable = [
		'peserta_id',
		'golongan_darah',
		'riwayat_penyakit',
		'riwayat_alergi'
	];

	public function peserta()
	{
		return $this->belongsTo(Peserta::class);
	}
}
