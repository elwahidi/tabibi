<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $assistance_id
 * @property integer $doctor_id
 * @property User $assistance
 * @property User $doctor
 */
class Assistance extends Model
{
    protected $fillable = [
        'assistance_id', 'doctor_id',
    ];

    public function assistance()
    {
        return $this->belongsTo(User::class,'assistance_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
}
