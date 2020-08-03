<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class Draft extends Model
{

    protected $fillable = [
        'user_id', 'title', 'registered_date', 'explanation', 'auth_1', 'auth_2', 'auth_3', 'auth_4', 'auth_5', 'process'
    ];

    public static function RegisterDraft($request, $title, $registered_date, $explanation, $auth_1, $auth_2, $auth_3, $auth_4, $auth_5) {
        
        $draftData = Draft::create([
            'user_id'=>Auth::User()->id,
            'title'=>$title,
            'registered_date'=>$registered_date,
            'explanation'=>$explanation,
            'auth_1'=>$auth_1,
            'auth_2'=>$auth_2,
            'auth_3'=>$auth_3,
            'auth_4'=>$auth_4,
            'auth_5'=>$auth_5,
            'process'=>'auth_1'

        ]);

        $path = storage_path() . '/app/public/files/' . Auth::User()->id .'/'. $draftData->id;
        File::makeDirectory($path, 0777, true);

        $filePath = storage_path() . '/app/public/files/' . Auth::User()->id .'/'. $draftData->id .'/'. 'file';
        File::makeDirectory($filePath, 0777, true);

        $refPath = storage_path() . '/app/public/files/' . Auth::User()->id .'/'. $draftData->id .'/'. 'ref';
        File::makeDirectory($refPath, 0777, true);
      
        $filePath02 = 'files/' . Auth::User()->id .'/'. $draftData->id .'/'. 'file';
        $refPath02 = 'files/' . Auth::User()->id .'/'. $draftData->id .'/'. 'ref';

        $draft = Draft::where('id',$draftData->id)->first();
       
        //Draftテーブルのカラム「file」の数だけループ
        for($i=1;$i<5;$i++) {
            $file = $request->file('file_'.$i);
            if( isset($file) === true ){
                $ext = $file->guessExtension();
                $filename = $file->getClientOriginalName();
                $filePath03 = $file->storeAs($filePath02, $filename, 'public');
                $file_num = 'file_'.$i;
                $draft->{$file_num} = basename($filePath03);
                $draft->save();
            }
        }

        //Draftテーブルのカラム「ref」の数だけループ
        for($i=1;$i<5;$i++) {
            $ref = $request->file('ref_'.$i);
            if( isset($ref) === true ){
                $ext = $ref->guessExtension();
                $filename = $ref->getClientOriginalName();
                $refPath03 = $ref->storeAs($refPath02, $filename, 'public');
                $ref_num = 'ref_'.$i;
                $draft->{$ref_num} = basename($refPath03);
                $draft->save();
            }
        }
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
                    //auth_1〜auth_5においてログインユーザーがレコードにあるかどうか確認
                    if($process[$i] !== 'auth_0' && $process[$i] !== 'auth_6') {
                        $query->orWhere($process[$i], Auth::User()->name)
                              ->where('drafts.id',$id[$i]);
                    }
                }
            })->get();
            
        
            foreach($row as $val) {
                //auth_1〜auth_5の末尾の数値のみ抜き出し
                $added_data_place = mb_substr($val['process'], -1, 1);
                //抜き出した数値に＋１を加える
                $added_data_place += 1;
                 //＋１したauthを置き換えて変数に代入
                $replace_data[] = substr_replace($val['process'], $added_data_place, 5, 1);
                $process_2[] = $val->process;
                $id_2[] = $val->id;
            }
            
            if(!empty($replace_data)) {
                for($i=0;$i<count($replace_data);$i++) {
                    if($replace_data[$i] === 'auth_6') {
                        $replace_data[$i] = 'auth_5';
                    }
                    $row_2[] = Draft::select("$replace_data[$i] as next_person",
                                            'drafts.id','title','drafts.created_at','name')
                                    ->join('users','users.id','=','drafts.user_id')
                                    ->where(function($query) use($process_2, $id_2, $i) {
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

        //auth_1〜auth_5の末尾の数値のみ抜き出し
        $added_data_place = mb_substr($data['process'], -1, 1);

        //抜き出した数値に＋１を加える
        $added_data_place += 1;

        //＋１したauthを置き換えて変数に代入
        $replace_data = substr_replace($data['process'], $added_data_place, 5, 1);

        Draft::where('id',$id)->update(['process'=>$replace_data]);

        $updated_data = Draft::select('process')->where('id',$id)->first();

        //カラム「auth_6」は存在しないため除外
        if($updated_data->process !== 'auth_6') {
            $status = Draft::where('id',$id)->select($updated_data->process)->first();
        } else {
            $status = NULL;
        }

        if($status === NULL || $status->{$updated_data['process']} === '---' ) {
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
                if($process[$i] !== 'auth_0' && $process[$i] !== 'auth_6') {
                    $row[] = Draft::select("$process[$i] as name",'title','Authorization','id','created_at')
                        ->where(function($query) use($id, $i){
                                $query->orWhere('id',$id[$i]);
                        })
                        ->where($process[$i],'!=', '---')
                        ->where($process[$i],'!=', NULL)
                        ->get();
                }
            }
            
            if(!empty($row)) {
                foreach($row as $val) {
                    if(empty($val[0])) {
                        unset($val[0]);
                    } else {
                        $index[] = $val[0]; 
                    }
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

    public static function deleteFile($id, $num) {
       $delFile = self::where('id', $id)->first();
       $delFileName = $delFile->{$num};

       if($num === 'file_1' || $num === 'file_2'|| $num === 'file_3' || $num === 'file_4') {
           $pathDel = storage_path() . '/app/public/files/' . Auth::User()->id .'/'. $id .'/'. 'file/' . $delFileName;
           \File::delete($pathDel);
       } else {
           $pathDel = storage_path() . '/app/public/files/' . Auth::User()->id .'/'. $id .'/'. 'ref/' . $delFileName;
           \File::delete($pathDel);
       }

       self::where('id', $id)->update([$num => NULL]);

    }

    public static function deleteTaskFile($id) {
        for($i=1;$i<5;$i++) {
            $file_num = 'file_'. $i;
            $file[] = self::select("$file_num")
                           ->where("$file_num",'!=', NULL)
                           ->where('id',$id)
                           ->get();
        }

        foreach($file as $val) {
            if(empty($val[0])) {
                unset($val[0]);
            } else {
                $index[] = $val[0]; 
            }
        }
       
        if(!empty($index)) {
            for($i=0;$i<count($index);$i++) {
                for($j=1;$j<5;$j++) {
                    $num = 'file_'.$j;
                    if($index[$i]->{$num} !== NULL) {
                        $delFileName = $index[$i]->{$num};
                        $pathDel = storage_path() . '/app/public/files/' . Auth::User()->id .'/'. $id .'/'. 'file/' . $delFileName;
                        \File::delete($pathDel);
                    }
                }
            }
        }
    }

    public static function deleteTaskRef($id) {
        for($i=1;$i<5;$i++) {
            $file_num = 'ref_'. $i;
            $file[] = self::select("$file_num")
                           ->where("$file_num",'!=', NULL)
                           ->where('id',$id)
                           ->get();
        }

        foreach($file as $val) {
            if(empty($val[0])) {
                unset($val[0]);
            } else {
                $index[] = $val[0]; 
            }
        }
       
        if(!empty($index)) {
            for($i=0;$i<count($index);$i++) {
                for($j=1;$j<5;$j++) {
                    $num = 'ref_'.$j;
                    if($index[$i]->{$num} !== NULL) {
                        $delFileName = $index[$i]->{$num};
                        $pathDel = storage_path() . '/app/public/files/' . Auth::User()->id .'/'. $id .'/'. 'ref/' . $delFileName;
                        \File::delete($pathDel);
                    }
                }
            }
        }
    }
}
