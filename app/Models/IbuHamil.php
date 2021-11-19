<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IbuHamil.
 *
 * @property int $id
 * @property int $peserta_id
 * @property string $golongan_darah
 * @property string $riwayat_penyakit
 * @property string $riwayat_alergi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Peserta $peserta
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil query()
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil whereGolonganDarah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil wherePesertaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil whereRiwayatAlergi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil whereRiwayatPenyakit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IbuHamil whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IbuHamil extends Model
{
    protected $table = 'ibu_hamils';

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
