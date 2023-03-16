<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    CONST ROLE_USER = [
        1 => 'Administrator',
        2 => 'Kepala BAK',
        3 => 'Kaprodi',
        4 => 'Mahasiswa'
    ];

    CONST ADMIN         = 1;
    CONST KEPALA_BAK    = 2;
    CONST KAPRODI       = 3;
    CONST MAHASISWA     = 4;

    public function UserRole(){
    	return $this->hasOne('App\RoleUser', 'id_role', 'id_role');
    }

    public function Pegawai(){
    	return $this->hasOne('App\Pegawai', 'nidn', 'user_name');
    }

    public function Mahasiswa(){
    	return $this->hasOne('App\Mahasiswa', 'npm', 'user_name');
    }

    public static function Is_Mahasiswa()
    {
        $user = Auth::user()->UserRole;
        if ($user->id_role === self::MAHASISWA) {
            return true;
        }
        return false;
    }

    public static function Is_Admin()
    {
        $user = Auth::user()->UserRole;
        if ($user->id_role === self::ADMIN) {
            return true;
        }
        return false;
    }

    public static function Is_Kepala_BAK()
    {
        $user = Auth::user()->UserRole;
        if ($user->id_role === self::KEPALA_BAK) {
            return true;
        }
        return false;
    }

    public static function Is_Kaprodi()
    {
        $user = Auth::user()->UserRole;
        if ($user->id_role === self::KAPRODI) {
            return true;
        }
        return false;
    }
}

