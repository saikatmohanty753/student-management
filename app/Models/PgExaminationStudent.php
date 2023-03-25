<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PgExaminationStudent extends Model
{
    use HasFactory;

    public function pgexamstd()
    {
        return $this->belongsTo(StudentDetails::class, 'std_id', 'id');
    }

}
