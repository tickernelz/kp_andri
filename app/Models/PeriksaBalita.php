<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PeriksaBalita.
 *
 * @property int $id
 * @property int $pemeriksaan_id
 * @property float $berat_badan
 * @property float $tinggi_badan
 * @property float $lingkar_kepala
 * @property int $imunisasi_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Imunisasi $imunisasi
 * @property Pemeriksaan $pemeriksaan
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita query()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita whereBeratBadan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita whereImunisasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita whereLingkarKepala($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita wherePemeriksaanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita whereTinggiBadan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaBalita whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PeriksaBalita extends Model
{
    protected $table = 'periksa_balitas';

    protected $casts = [
        'pemeriksaan_id' => 'int',
        'berat_badan' => 'float',
        'tinggi_badan' => 'float',
        'lingkar_kepala' => 'float',
        'imunisasi_id' => 'int',
    ];

    protected $fillable = [
        'pemeriksaan_id',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'imunisasi_id',
    ];

    public function imunisasi()
    {
        return $this->belongsTo(Imunisasi::class);
    }

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
}
