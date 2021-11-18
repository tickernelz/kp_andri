<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pemeriksaan
 * 
 * @property int $id
 * @property int $peserta_id
 * @property Carbon $tanggal
 * @property string $keluhan
 * @property string|null $penanganan
 * @property string|null $catatan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Peserta $peserta
 * @property Collection|PeriksaBalita[] $periksa_balitas
 * @property Collection|PeriksaIbuHamil[] $periksa_ibu_hamils
 * @property Collection|PeriksaLansia[] $periksa_lansias
 *
 * @package App\Models
 */
class Pemeriksaan extends Model
{
	protected $table = 'pemeriksaans';

	protected $casts = [
		'peserta_id' => 'int'
	];

	protected $dates = [
		'tanggal'
	];

	protected $fillable = [
		'peserta_id',
		'tanggal',
		'keluhan',
		'penanganan',
		'catatan'
	];

	public function peserta()
	{
		return $this->belongsTo(Peserta::class);
	}

	public function periksa_balitas()
	{
		return $this->hasMany(PeriksaBalita::class);
	}

	public function periksa_ibu_hamils()
	{
		return $this->hasMany(PeriksaIbuHamil::class);
	}

	public function periksa_lansias()
	{
		return $this->hasMany(PeriksaLansia::class);
	}
}
