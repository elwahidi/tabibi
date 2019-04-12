<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $consultation
 * @property string $visit
 * @property integer $appointment_id
 * @property Appointment $appointment
 */
class Form extends Model
{
    protected $fillable = ['consultation', 'visit', 'appointment_id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
