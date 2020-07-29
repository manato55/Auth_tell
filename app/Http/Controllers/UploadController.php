<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HomeRequest; 
use App\Draft;

class UploadController extends Controller
{

    public function __construct()
   {
       $this->middleware('auth');
   }

    public function store(HomeRequest $request){

        Draft::RegisterDraft($request, $request->title, $request->registered_date, $request->explanation, $request->auth_1, $request->auth_2, $request->auth_3, $request->auth_4, $request->auth_5);

        return redirect('/home')->with('msg','登録しました');
                
    }
}
