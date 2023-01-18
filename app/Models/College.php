<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    protected $table = 'colleges';
    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'old_clg_code',
        'college_code',
        'exam_code',
        'district_id',
        'city',
        'college_type_id',
        'affiliation_type_id',
        'address',
        'status',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function cityName()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }
    public function clgType()
    {
        return $this->belongsTo(CollegeType::class, 'college_type_id', 'id');
    }
    public function affType()
    {
        return $this->belongsTo(AffiliationType::class, 'affiliation_type_id', 'id');
    }

    public static function totalCollege(){
        return College::count();
    }
    public static function allCollege(){
        return College::all();
    }
}
