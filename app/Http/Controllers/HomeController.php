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
        $index = Draft::ShowDetail($request->id);
        $task_holder = Draft::select("$index->process as name")
                            ->where('id',$request->id)
                            ->where('authorization','!=','done')
                            ->first();
        
        $back = url()->previous();
        
        return view('detail',[
            'index'=>$index,
            'back'=>$back,
            'task_holder'=>$task_holder,
        ]);

    }

    public function delete($id) {
        Draft::find($id)->delete();

        return redirect('authorized');
    }
}
