<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lansia.
 *
 * @property int $id
 * @property int $peserta_id
 * @property string $golongan_darah
 * @property string $riwayat_penyakit
 * @property string $riwayat_alergi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Peserta $peserta
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia whereGolonganDarah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia wherePesertaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia whereRiwayatAlergi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia whereRiwayatPenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lansia whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lansia extends Model
{
    protected $table = 'lansias';

    protected $casts = [
        'peserta_id' => 'int',
    ];

    protected $fillable = [
        'peserta_id',
        'golongan_darah',
        'riwayat_penyakit',
        'riwayat_alergi',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
