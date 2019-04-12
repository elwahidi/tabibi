<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $category
 * @property User $users
 */
class Category extends Model
{
    protected $fillable = ['category'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
