<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliationMaster extends Model
{
    use HasFactory;
    protected $table = 'affiliation_masters';

/*     public function stream()
    {
        return $this->belongsTo(CourseFor::class, 'stream_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(CourseType::class, 'category_id', 'id');
    } */
    public function courseName()
    {
        return $this->belongsTo(Course::class, 'course', 'id');
    }
}
