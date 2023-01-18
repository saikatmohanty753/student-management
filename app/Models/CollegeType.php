<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeType extends Model
{
    use HasFactory;
    protected $table = 'college_types';
    protected $fillable = [
        'type',
        'status',
    ];
    // public static function clgType($id){
    //     $data = CollegeType::where('id', $id)->first();
    //     return $data->attributesToArray;
    //     if (!empty($data)) {
    //         $type = $data->clg_type;
    //     } else {
    //         $type = '';

    //     }


    // }
}
