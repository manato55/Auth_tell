<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Draft;
use App\User;
use App\RetrievedTask;
use App\Http\Requests\HomeRequest; 


class RetrievedTaskController extends Controller
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

   public function retrieve(request $request) {
       RetrievedTask::SelfRetrieve($request->id);
       Draft::RetrieveTask($request->id);

       return redirect('/pending_process');
   }

   public function index() {
       $index = Draft::GetRetrievedIndex();

        return view('retrieve',[
            'index'=>$index,
        ]);

   }

   public function retrieveToSenderIndex(request $request) {
        $index = Draft::where('id',$request->id)->first();

        return view('retrieveSenderIndex',[
            'index'=>$index,
        ]);

   }

   public function retrieveToSender(request $request) {
       
       RetrievedTask::RetrieveToSender($request->id, $request->comment);
       Draft::RetrieveTask($request->id);

        return redirect('/pending');

   }

   public function taskModificationIndex(request $request) {
        $index = Draft::GetTaskModificationIndex($request->id);
      
        $data = User::SameSection();

        if(empty(old('registered_date'))) {
            $var_date = date('Y-m-d', strtotime($index->registered_date));
        } else {
            $var_date = date('Y-m-d', strtotime(old('registered_date')));
        }

        $back = url()->previous();

        return view('modification',[
            'index'=>$index,
            'data'=>$data,
            'var_date'=>$var_date,
            'back'=>$back,
        ]);
   }

   public function reSubmit(HomeRequest $request) {
       
       RetrievedTask::Resubmit($request, $request->id, $request->submit, $request->title, $request->registered_date, $request->explanation, 
                                $request->auth_1, $request->auth_2, $request->auth_3, $request->auth_4, $request->auth_5,
                                $request->file_1, $request->file_2, $request->file_3, $request->file_4,
                                $request->ref_1, $request->ref_2, $request->ref_3, $request->ref_4);
       
       return redirect('/retrieve');
   }

   public function delete(request $request) {
        Draft::where('id', $request->id)->update([$request->num => NULL]);

        return redirect()->action('RetrievedTaskController@taskModificationIndex',[
                                                    'id'=>$request->id,
                                                ]); 
   }
}
