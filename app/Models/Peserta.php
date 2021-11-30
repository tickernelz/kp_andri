<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Peserta.
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
 * @property Collection|Balita[] $balitas
 * @property Collection|IbuHamil[] $ibu_hamils
 * @property Collection|Lansia[] $lansias
 * @property Collection|Pemeriksaan[] $pemeriksaans
 * @property-read int|null $balitas_count
 * @property-read int|null $ibu_hamils_count
 * @property-read int|null $lansias_count
 * @property-read int|null $pemeriksaans_count
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereKk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peserta whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Balita|null $balita
 * @property-read \App\Models\IbuHamil|null $ibu_hamil
 * @property-read \App\Models\Lansia|null $lansia
 * @property-read \App\Models\Pemeriksaan|null $pemeriksaan
 */
class Peserta extends Model
{
    protected $table = 'pesertas';

    protected $casts = [
        'nik' => 'int',
        'kk' => 'int',
    ];

    protected $dates = [
        'tanggal_lahir',
    ];

    protected $fillable = [
        'nik',
        'kk',
        'nama',
        'alamat',
        'kelamin',
        'tanggal_lahir',
        'hp',
    ];

    public function balita()
    {
        return $this->hasOne(Balita::class);
    }

    public function ibu_hamil()
    {
        return $this->hasOne(IbuHamil::class);
    }

    public function lansia()
    {
        return $this->hasOne(Lansia::class);
    }

    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class);
    }
}
