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

    public static function SameSection() {
        $data = self::where('dep', Auth::User()->dep)
                    ->where('sec', Auth::User()->sec)
                    ->where('id','!=', Auth::User()->id)
                    ->orWhere(function($query) {
                        if(Auth::User()->role !== '部長') {
                        $query->where('dep', Auth::User()->dep)
                              ->where('role','LIKE', "%部長%");
                        }
                    })->orderByRaw("(CASE 
                    WHEN (role = '部長') THEN 1 
                    WHEN (role = '課長') THEN 2 
                    WHEN (role = '統括課長代理') 
                    THEN 3 WHEN (role = '課長代理') 
                    THEN 4 WHEN (role = '主任') THEN 5 
                    ELSE 9999 END)" 
                    )
                    ->get();

        return $data;
    }

    public static function ShowDetail($id) {
        $index = self::join('drafts','users.id','=','drafts.user_id')
                       ->where('drafts.id',$id)->first();
                      

        return $index;
    }

    public static function ChangeAccount($request) {
        $user = self::where('id',Auth::User()->id)->first();
        $user->fill($request->all())->save();
    }
}
