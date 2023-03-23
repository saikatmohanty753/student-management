<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BseExamine extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id',
        'course',
        'theory_practical',
        'description',
        
        
    ];
}
