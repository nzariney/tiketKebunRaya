<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    'user_id',
    'invoice_code',
    'visit_date',
    'adult_quantity',
    'child_quantity',
    'adult_price',
    'child_price',
    'total_price',
    'payment_proof',
    'status',
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
