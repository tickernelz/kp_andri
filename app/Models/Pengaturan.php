<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pengaturan
 *
 * @property int $id
 * @property string $nama_aplikasi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereNamaAplikasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengaturan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pengaturan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];
}
