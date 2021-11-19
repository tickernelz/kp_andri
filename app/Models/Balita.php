<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Balita.
 *
 * @property int $id
 * @property int $peserta_id
 * @property string $ayah
 * @property string $ibu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Peserta $peserta
 * @method static \Illuminate\Database\Eloquent\Builder|Balita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Balita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Balita query()
 * @method static \Illuminate\Database\Eloquent\Builder|Balita whereAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balita whereIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balita wherePesertaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balita whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Balita extends Model
{
    protected $table = 'balitas';

    protected $casts = [
        'peserta_id' => 'int',
    ];

    protected $fillable = [
        'peserta_id',
        'ayah',
        'ibu',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
