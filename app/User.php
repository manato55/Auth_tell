<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth; 
use App\Draft;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dep', 'sec', 'team', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function draft()
    {
        return $this->hasMany(Draft::class,'user_id','id');
    }

    public static function SameSection() {
        $data = self::where('dep', Auth::User()->dep)
                    ->where('sec', Auth::User()->sec)
                    ->where('id','!=', Auth::User()->id)
                    ->orWhere(function($query) {
                        $query->where('dep', Auth::User()->dep)
                              ->where('role','LIKE', "%部長%");
                    })
                    ->get();

        return $data;
    }
}
