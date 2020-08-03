<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\SettingRequest; 


class AccountSettingController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $index = User::where('id',Auth::User()->id)->first();

        if(empty(old('name'))) {
            $var_name = $index->name;
        } else {
            $var_name = old('name');
        }

        if(empty(old('email'))) {
            $var_email = $index->email;
        } else {
            $var_email = old('email');
        }

        if(empty(old('dep'))) {
            $var_dep = $index->dep;
        } else {
            $var_dep = old('dep');
        }

        if(empty(old('sec'))) {
            $var_sec = $index->sec;
        } else {
            $var_sec = old('sec');
        }

        if(empty(old('team'))) {
            $var_team = $index->team;
        } else {
            $var_team = old('team');
        }

        if(empty(old('role'))) {
            $var_role = $index->role;
        } else {
            $var_role = old('role');
        }

        return view('accountSetting',[
            'index'=>$index,
            'var_name'=>$var_name,
            'var_email'=>$var_email,
            'var_dep'=>$var_dep,
            'var_sec'=>$var_sec,
            'var_team'=>$var_team,
            'var_role'=>$var_role,
            ]);

    }

    public function changeAccount(SettingRequest $request) {

        User::ChangeAccount($request);

        return redirect()->route('account')->with('msg','変更しました。');
    }
}
