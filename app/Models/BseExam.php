<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BseExam extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id',
        'year',
        'name_of_exam',
        'roll_no',
        'regd_no',
        
    ];
}
