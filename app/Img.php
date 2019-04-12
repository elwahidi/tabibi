<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $img
 * @property integer $establishment_id
 * @property Establishment $establishment
 */
class Img extends Model
{
    protected $fillable = ['img', 'establishment_id'];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
