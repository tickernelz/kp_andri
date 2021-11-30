<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pemeriksaan.
 *
 * @property int $id
 * @property int $peserta_id
 * @property Carbon $tanggal
 * @property string $keluhan
 * @property string|null $penanganan
 * @property string|null $catatan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Peserta $peserta
 * @property Collection|PeriksaBalita[] $periksa_balitas
 * @property Collection|PeriksaIbuHamil[] $periksa_ibu_hamils
 * @property Collection|PeriksaLansia[] $periksa_lansias
 * @property-read int|null $periksa_balitas_count
 * @property-read int|null $periksa_ibu_hamils_count
 * @property-read int|null $periksa_lansias_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan whereKeluhan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan wherePenanganan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan wherePesertaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pemeriksaan whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\PeriksaBalita|null $periksa_balita
 * @property-read \App\Models\PeriksaIbuHamil|null $periksa_ibu_hamil
 * @property-read \App\Models\PeriksaLansia|null $periksa_lansia
 */
class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaans';

    protected $casts = [
        'peserta_id' => 'int',
    ];

    protected $dates = [
        'tanggal',
    ];

    protected $fillable = [
        'peserta_id',
        'tanggal',
        'keluhan',
        'penanganan',
        'catatan',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }


    public function periksa_balita()
    {
        return $this->hasOne(PeriksaBalita::class);
    }


    public function periksa_ibu_hamil()
    {
        return $this->hasOne(PeriksaIbuHamil::class);
    }


    public function periksa_lansia()
    {
        return $this->hasOne(PeriksaLansia::class);
    }
}
