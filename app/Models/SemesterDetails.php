<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemesterDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id',
        'semester_no',
        'payment_status',
        'mid_semester',
        'total_mark',
    ];
}
