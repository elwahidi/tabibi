<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property boolean $experience
 * @property string $name
 * @property string $address
 * @property integer $build
 * @property integer $floor
 * @property integer $apt_nbr
 * @property integer $zip
 * @property Carbon $start
 * @property Carbon $end
 * @property integer $doctor_id
 * @property User $doctor
 */
class Experience extends Model
{
    protected $fillable = [
        'experience', 'name', 'address', 'build', 'floor', 'apt_nbr', 'zip', 'start', 'end',
        'doctor_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
}
