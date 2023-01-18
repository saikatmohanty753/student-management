<?php



namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable

{

    use HasFactory, Notifiable, HasRoles;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'clg_id',
        'role_id',
        'is_active',
        'mob_no',
    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast to native types.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public static function CreateTempCollege($data){

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 5,
            'is_active' => 0,
            'password' => Hash::make(12345678),
        ]);

    }
}
