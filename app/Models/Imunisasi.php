<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Imunisasi.
 *
 * @property int $id
 * @property string $nama
 * @property string|null $kegunaan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|PeriksaBalita[] $periksa_balitas
 * @property-read int|null $periksa_balitas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi whereKegunaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imunisasi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Imunisasi extends Model
{
    protected $table = 'imunisasis';

    protected $fillable = [
        'nama',
        'kegunaan',
    ];

    public function periksa_balitas()
    {
        return $this->hasMany(PeriksaBalita::class);
    }
}
