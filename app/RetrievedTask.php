<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class RetrievedTask extends Model
{
    protected $fillable = [
        'retriever, retrieved_ppl, retrieved_task'
    ];

    public static function SelfRetrieve($id) {
        $data = Draft::where('id',$id)->first();
        $user = Draft::select("$data->process as name")->where('id',$id)->first();
        $name = User::where('name',$user->name)->first();

        $task = new RetrievedTask;
        
        $task->retriever = $name->id;
        $task->retrieved_ppl = Auth::User()->id;
        $task->retrieved_task = $id;
        $task->intercepted_auth = $data->process;

        $task->save();
      

    }

    public static function RetrieveToSender($id, $comment) {
        $user_id = Draft::where('id',$id)->first();

        $task = new RetrievedTask;

        $task->retriever = Auth::User()->id;
        $task->retrieved_ppl = $user_id->user_id;
        $task->retrieved_task = $id;
        $task->comment = $comment;
        $task->intercepted_auth = $user_id->process;

        $task->save();
    }

    public static function ReSubmit($request, $id, $submit, $title, $registered_date, $explanation, $auth_1, $auth_2, $auth_3, $auth_4, $auth_5, $file_1, $file_2, $file_3, $file_4, $ref_1, $ref_2, $ref_3, $ref_4) {
        if($submit === 'submit_2') {
            Draft::where('id',$id)->update([
                                    'title'=>$title,
                                    'registered_date'=>$registered_date,
                                    'explanation'=>$explanation,
                                    'auth_1'=>$auth_1,
                                    'auth_2'=>$auth_2,
                                    'auth_3'=>$auth_3,
                                    'auth_4'=>$auth_4,
                                    'auth_5'=>$auth_5,
                                    'process'=>'auth_1',
                                    ]);
                  
            $file = Draft::where('id',$id)->first();
    
            for($i=1;$i<5;$i++) {
                if($request->hasFile('file_'.$i)) {
                    $num = 'file_'.$i;
                    Storage::delete('public/files/' . $file->{$num});
                    $filename = $request->file('file_'.$i)->getClientOriginalName();
                    $path = $request->file('file_'.$i)->storeAs('files', $filename, 'public');
                    $file->{$num} = basename($path);
                    $file->save();
                }
            }
    
            for($i=1;$i<5;$i++) {
                if($request->hasFile('ref_'.$i)) {
                    $num = 'ref_'.$i;
                    Storage::delete('public/files/' . $file->{$num});
                    $filename = $request->file('ref_'.$i)->getClientOriginalName();
                    $path = $request->file('ref_'.$i)->storeAs('files', $filename, 'public');
                    $file->{$num} = basename($path);
                    $file->save();
                }
            }

            self::where('retrieved_task',$id)->delete();
            
        } else if($submit === 'submit_1') {
            Draft::where('id',$id)->update([
                                    'title'=>$title,
                                    'registered_date'=>$registered_date,
                                    'explanation'=>$explanation,
                                    'auth_1'=>$auth_1,
                                    'auth_2'=>$auth_2,
                                    'auth_3'=>$auth_3,
                                    'auth_4'=>$auth_4,
                                    'auth_5'=>$auth_5,
                                    ]);

            $file = Draft::where('id',$id)->first();

            for($i=1;$i<5;$i++) {
                if($request->hasFile('file_'.$i)) {
                    $num = 'file_'.$i;
                    Storage::delete('public/files/' . $file->{$num});
                    $filename = $request->file('file_'.$i)->getClientOriginalName();
                    $path = $request->file('file_'.$i)->storeAs('files', $filename, 'public');
                    $file->{$num} = basename($path);
                    $file->save();
                }
            }
    
            for($i=1;$i<5;$i++) {
                if($request->hasFile('ref_'.$i)) {
                    $num = 'ref_'.$i;
                    Storage::delete('public/files/' . $file->{$num});
                    $filename = $request->file('ref_'.$i)->getClientOriginalName();
                    $path = $request->file('ref_'.$i)->storeAs('files', $filename, 'public');
                    $file->{$num} = basename($path);
                    $file->save();
                }
            }

            $auth_num = RetrievedTask::where('retrieved_task',$id)->first();
 
            Draft::where('id',$id)->update(['process'=>$auth_num->intercepted_auth]);
            RetrievedTask::where('retrieved_task',$id)->delete();
 
        } else {
            Draft::where('id',$id)->delete();
            self::where('retrieved_task',$id)->delete();

            return redirect('/retrieve');
        }
       
    }
}
