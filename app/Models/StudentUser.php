<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class StudentUser extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public function role():BelongsToMany
    {
        return $this->BelongsToMany(Role::class, 'role_id', 'id');
    }

    public function userdetails()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
