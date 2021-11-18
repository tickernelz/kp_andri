<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Peserta
 * 
 * @property int $id
 * @property int|null $nik
 * @property int|null $kk
 * @property string $nama
 * @property string|null $alamat
 * @property string|null $kelamin
 * @property Carbon $tanggal_lahir
 * @property string|null $hp
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Balita[] $balitas
 * @property Collection|IbuHamil[] $ibu_hamils
 * @property Collection|Lansia[] $lansias
 * @property Collection|Pemeriksaan[] $pemeriksaans
 *
 * @package App\Models
 */
class Peserta extends Model
{
	protected $table = 'pesertas';

	protected $casts = [
		'nik' => 'int',
		'kk' => 'int'
	];

	protected $dates = [
		'tanggal_lahir'
	];

	protected $fillable = [
		'nik',
		'kk',
		'nama',
		'alamat',
		'kelamin',
		'tanggal_lahir',
		'hp'
	];

	public function balitas()
	{
		return $this->hasMany(Balita::class);
	}

	public function ibu_hamils()
	{
		return $this->hasMany(IbuHamil::class);
	}

	public function lansias()
	{
		return $this->hasMany(Lansia::class);
	}

	public function pemeriksaans()
	{
		return $this->hasMany(Pemeriksaan::class);
	}
}
