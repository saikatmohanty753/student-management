<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperSubType extends Model
{
    use HasFactory;

    public function papersubtype()
    {
        return $this->belongsTo(Paper::class, 'paper_type_id', 'id');
    }
}
