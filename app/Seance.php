<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed $seance
 * @property mixed $price
 * @property integer $doctor_id
 * @property User $doctor
 */
class Seance extends Model
{
    protected $fillable = ['seance', 'price', 'doctor_id'];

    public $timestamps = false;

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
}
