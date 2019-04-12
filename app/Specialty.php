<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $icon
 * @property string $specialty
 * @property string $description
 * @property User $users
 */
class Specialty extends Model
{
    protected $fillable = ['icon', 'specialty', 'description'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
