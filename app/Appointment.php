<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property mixed $price
 * @property integer $establishment_id
 * @property integer $patient_id
 * @property integer $calendar_id
 * @property string $reason
 * @property Establishment $establishment
 * @property User $doctor
 * @property User $patient
 * @property Calendar $calendar
 * @property Form $forms
 */
class Appointment extends Model
{
    // update reason_id with reason [string]

    protected $fillable = [
        'price', 'reason', 'patient_id', 'calendar_id',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class,'patient_id');
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
