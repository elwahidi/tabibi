<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $sexe
 * @property User $users
 */
class Sexe extends Model
{
    protected $fillable = ['sexe'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class,'sexe_id');
    }
}
