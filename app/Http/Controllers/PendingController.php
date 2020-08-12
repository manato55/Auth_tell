<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth; 
use App\Draft;
use App\User;


class PendingController extends Controller
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
        $index = Draft::PendingIndex();

        return view('pending',[
            'index'=>$index,
        ]);
    }

    public function approval(request $request) {
        Draft::Escalation($request->id);

        return redirect()->action('PendingController@index');
    }

    public function process() {
        $index = Draft::PendingProcess();

        return view('pending_process',[
            'index'=>$index,
        ]);

    }

    public function authorized() {
        //単純なDB処理のためコントローラーに記載
        $index = Draft::where('user_id', Auth::User()->id)
                       ->where('authorization', 'done')
                       ->get();

        return view('authorized',[
            'index'=>$index,
        ]);
    }
}
