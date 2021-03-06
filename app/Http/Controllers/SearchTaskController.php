<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draft;

class SearchTaskController extends Controller
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
        
        return view('search');

    }

    public function search(request $request) {
    
        //検索範囲が「課内」の場合
        if($request->search_range === 'sec') {
            if($request->search_title !== '') {
                $index = Draft::searchTaskSec($request->search_title);
            } else {
                $index = '';
            }
        //検索範囲が「担当内」の場合
        } else {
            if($request->search_title !== '') {
                $index = Draft::searchTaskTeam($request->search_title);
            } else {
                $index = '';
            }
        }

        $selected_range = $request->search_range;
        $search_title = $request->search_title;

        return view('search',[
            'index'=>$index,
            'selected_range'=>$selected_range,
            'search_title'=>$search_title,
        ]);
    }
}
