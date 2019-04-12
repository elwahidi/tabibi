<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $payment_method
 * @property Invoice $invoices
 */
class PaymentMethod extends Model
{
    protected $fillable = ['payment_method'];

    public $timestamps = false;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
