<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_id',
        'transaction_id',
        'transaction_response',
        'payment_request_id',
        'transaction_date', 
        'amount', 
    ];
}
