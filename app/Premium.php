<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $limit
 * @property integer $establishment_id
 * @property Establishment $establishment
 * @property Invoice $invoices
 */
class Premium extends Model
{
    protected $table = 'premiums';

    protected $fillable = ['limit', 'establishment_id'];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
