<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Draft;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::SameSection();

        if(empty(old('registered_date'))) {
            $var_date = date('Y-m-d');
        } else {
            $var_date = date('Y-m-d', strtotime(old('registered_date')));
        }

        return view('home', [
            'data' => $data,
            'var_date' => $var_date,
        ]);
    }

    public function detail(request $request) { 
        $index = User::ShowDetail($request->id);
      
        //ユーザーの役職名取得
        $get_role = User::where(function($query)use($index) {
            for($i=1;$i<6;$i++) {
                $auth_num = 'auth_'.$i;
                    $query->orWhere('name', $index->{$auth_num});
                }
            })->get();
        
        //案件保持者の取得
        if($index->process !== 'auth_6') {
            $task_holder = Draft::select("$index->process as name")
                                ->where('id',$request->id)
                                ->where('authorization','!=','done')
                                ->first();
        //決定済みの案件はNULLとする
        } else {
            $task_holder = NULL;
        }
        
        
        return view('detail',[
            'index'=>$index,
            'back'=>url()->previous(),
            'task_holder'=>$task_holder,
            'get_role'=>$get_role,
        ]);

    }

    public function delete($id) {
        Draft::find($id)->delete();

        return redirect()->route('authorized');
    }
}
