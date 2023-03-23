<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PgExaminationApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id',
        'payment_status',
        'form_status',
        'app_status',
    ];
}
