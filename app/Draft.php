<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 


class Draft extends Model
{

    public static function RegisterDraft($request, $title, $registered_date, $explanation, $auth_1, $auth_2, $auth_3, $auth_4, $auth_5) {
        $draft = new Draft;
        $filename = '';

        for($i=1;$i<5;$i++) {
            $file = $request->file('file_'.$i);
            if( isset($file) === true ){
                $ext = $file->guessExtension();
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('files', $filename, 'public');
                $file_num = 'file_'.$i;
                $draft->{$file_num} = $filename;
            }

        }

        for($i=1;$i<5;$i++) {
            $ref = $request->file('ref_'.$i);
            if( isset($ref) === true ){
                $ext = $ref->guessExtension();
                $filename = $ref->getClientOriginalName();
                $path = $ref->storeAs('files', $filename, 'public');
                $ref_num = 'ref_'.$i;
                $draft->{$ref_num} = $filename;
            }

        }


        $draft->user_id = Auth::User()->id;
        $draft->title = $title;
        $draft->registered_date = $registered_date;
        $draft->explanation = $explanation;
        $draft->auth_1 = $auth_1;
        $draft->auth_2 = $auth_2;
        $draft->auth_3 = $auth_3;
        $draft->auth_4 = $auth_4;
        $draft->auth_5 = $auth_5;
        $draft->process = 'auth_1';
        $draft->save();
        

    }

    public static function ShowDetail($id) {
        $index = Draft::join('users','users.id','=','drafts.user_id')
                       ->where('drafts.id',$id)->first();

        return $index;
    }

    public static function PendingIndex() {
        $data = Draft::where(function($query) {
            //draftテーブルのカラム「auth」の数だけループさせる
            for($i=1;$i<6;$i++) {
                $query->orWhere('auth_'.$i, Auth::User()->name);
            }
        })->get();

        foreach($data as $val) {
            $process[] = $val->process;
            $id[] = $val->id;
        } 

        if(!empty($process) && !empty($id)) {
            $row = Draft::select('process','drafts.id')
                        ->where(function($query) use($process,$id) {
                for($i=0;$i<count($process);$i++) {
                    if($process[$i] !== 'auth_0') {
                        $query->orWhere($process[$i], Auth::User()->name)
                              ->where('drafts.id',$id[$i]);
                    }
                }
            })->get();
        
            foreach($row as $val) {
                $added_data_place = mb_substr($val['process'], -1, 1);
                $added_data_place += 1;
                $replace_data[] = substr_replace($val['process'], $added_data_place, 5, 1);
                $process_2[] = $val->process;
                $id_2[] = $val->id;
            }
            
            if(!empty($replace_data)) {
                for($i=0;$i<count($replace_data);$i++) {
                    if($replace_data[$i] === 'auth_6') {
                        $replace_data[$i] = 'auth_5';
                    }
                    $row_2[] = Draft::select("$replace_data[$i] as next_person",'drafts.id','title','drafts.created_at','name')
                                    ->join('users','users.id','=','drafts.user_id')
                                    ->where(function($query) use($process_2,$id_2,$i) {
                                        $query->orWhere($process_2[$i], Auth::User()->name)
                                                ->where('drafts.id',$id_2[$i]);
                                    })->get();

                }
                return $row_2;
            }

        }

    }

    public static function Escalation($id) {
        $data = Draft::where('id',$id)->select('process')->first();
        $added_data_place = mb_substr($data['process'], -1, 1);
        $added_data_place += 1;
        $replace_data = substr_replace($data['process'], $added_data_place, 5, 1);

        Draft::where('id',$id)->update(['process'=>$replace_data]);

        $updated_data = Draft::select('process')->where('id',$id)->first();

        $status = Draft::where('id',$id)->select($updated_data->process)->first();

        if($status->{$updated_data['process']} === '---' || $status->{$updated_data['process']} === NULL) {
            Draft::where('id',$id)->update(['Authorization'=>'done']);
        }
      
    }

    public static function PendingProcess() {
        $data = Draft::where('user_id', Auth::User()->id)->get();

        foreach($data as $val) {
            $id[] = $val->id;
            $process[] = $val->process;
        }

        if(!empty($id) && !empty($process)) {
            for($i=0;$i<count($data);$i++){
                if($process[$i] !== 'auth_0' ) {
                    $row[] = Draft::select("$process[$i] as name",'title','Authorization','id','created_at')
                        ->where(function($query) use($id,$i){
                                $query->orWhere('id',$id[$i]);
                        })
                        ->where($process[$i],'!=', '---')
                        ->where($process[$i],'!=', NULL)
                        ->get();
                }
            }
            
            foreach($row as $val) {
                if(empty($val[0])) {
                    unset($val[0]);
                } else {
                    $index[] = $val[0]; 
                }
            }

            if(!empty($index)) {
                return $index;
            }

        }
        
    }

    public static function RetrieveTask($id) {
        self::where('id',$id)->update(['process'=>'auth_0']);
    }

    public static function GetRetrievedIndex() {
        $index = Draft::select('drafts.id','title','name','retrieved_tasks.updated_at')
                        ->join('retrieved_tasks','drafts.id','=','retrieved_tasks.retrieved_task')
                        ->join('users','retrieved_tasks.retriever','=','users.id')
                        ->where('user_id', Auth::User()->id)
                        ->where('process','auth_0')
                        ->get();

        return $index;
    }

    public static function GetTaskModificationIndex($id) {
        $index = self::join('retrieved_tasks','drafts.id','=','retrieved_tasks.retrieved_task')
                        ->join('users','retrieved_tasks.retriever','=','users.id')
                        ->where('drafts.id',$id)
                        ->first();

        return $index;
    }
}
