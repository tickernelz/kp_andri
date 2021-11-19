<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PeriksaLansia.
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
 * @property Pemeriksaan $pemeriksaan
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia query()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereAsamUrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereBeratBadan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereGulaDarah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereKolesterol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia wherePemeriksaanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereTekananDarah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriksaLansia whereUpdatedAt($value)
 * @mixin \Eloquent
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
        'asam_urat' => 'float',
    ];

    protected $fillable = [
        'pemeriksaan_id',
        'berat_badan',
        'tekanan_darah',
        'gula_darah',
        'kolesterol',
        'asam_urat',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
}
