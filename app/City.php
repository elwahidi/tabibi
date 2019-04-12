<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $city
 * @property User $users
 * @property Establishment $establishments
 */
class City extends Model
{
    protected $fillable = ['city'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }
}
