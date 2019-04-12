<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $from
 * @property Carbon $to
 * @property Carbon $day
 * @property integer $doctor_id
 * @property integer $establishment
 * @property User $doctor
 * @property Carbon $start
 * @property Carbon $end
 */
class Calendar extends Model
{
    protected $fillable = [
        'from', 'to', 'day',
        'doctor_id', 'establishment_id'
    ];

    public function getStartAttribute()
    {
        return Carbon::parse($this->day)->format('Y-m-d');
    }

    public function getEndAttribute()
    {
        return Carbon::parse($this->day)->addDay()->format('Y-m-d');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }


}
