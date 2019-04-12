<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $invoice
 * @property Carbon $date
 * @property mixed $price
 * @property string $serial
 * @property integer $premium_id
 * @property integer $created_by
 * @property integer $payment_method_id
 * @property Establishment $establishment
 * @property User $creator
 * @property PaymentMethod $method
 */
class Invoice extends Model
{
    protected $fillable = [
        'invoice', 'date', 'price', 'serial',
        'establishment_id', 'created_by', 'payment_method_id'
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }
}
