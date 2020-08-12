<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckDuplication;
use App\Rules\CheckFileDuplication;
use App\Rules\CheckRefDuplication;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Draft;
use Illuminate\Support\Facades\Auth; 


class HomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

   
    public function rules(request $request)
    {
        
        return [
            'title' => 'required|max:30', 
            'registered_date' => 'required', 
            'explanation' => 'required|max:400',
            'file_1' => [
                'file',
                'image',
                new CheckFileDuplication($this->file_1, $this->file_2, $this->file_3, $this->file_4),
                //添付したファイル名が他の添付ファイル名と重複していないかチェック
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=2;$i<5;$i++) {
                        $file_num = 'file_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$file_num}) {
                            return $fail('依頼文等のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'file_2' => [
                'file',
                'image',
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=1;$i<5;$i++) {
                        if($i === 2) {
                            continue;
                        }
                        $file_num = 'file_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$file_num}) {
                            return $fail('依頼文等のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'file_3' => [
                'file',
                'image',
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=1;$i<5;$i++) {
                        if($i === 3) {
                            continue;
                        }
                        $file_num = 'file_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$file_num}) {
                            return $fail('依頼文等のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'file_4' => [
                'file',
                'image',
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=1;$i<4;$i++) {
                        $file_num = 'file_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$file_num}) {
                            return $fail('依頼文等のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'ref_1' => [
                'file',
                'image',
                new CheckRefDuplication($this->ref_1, $this->ref_2, $this->ref_3, $this->ref_4,),
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=2;$i<5;$i++) {
                        $ref_num = 'ref_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$ref_num}) {
                            return $fail('参考資料のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'ref_2' => [
                'file',
                'image',
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=1;$i<5;$i++) {
                        if($i === 2) {
                            continue;
                        }
                        $ref_num = 'ref_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$ref_num}) {
                            return $fail('参考資料のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'ref_3' => [
                'file',
                'image',
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=1;$i<5;$i++) {
                        if($i === 3) {
                            continue;
                        }
                        $ref_num = 'ref_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$ref_num}) {
                            return $fail('参考資料のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'ref_4' => [
                'file',
                'image',
                function ($attribute, $value, $fail) use($request) {
                    $db_val = Draft::where('id',$request->id)->first();
                    for($i=1;$i<4;$i++) {
                        $ref_num = 'ref_'.$i;
                        if(isset($db_val) && $value->getClientOriginalName() === $db_val->{$ref_num}) {
                            return $fail('参考資料のファイルが登録済みのファイル'.$i.'と重複しています。');
                        }
                    }
                }
            ],
            'auth_1' => [
                function ($attribute, $value, $fail) {
                    if ($value === '---') {
                      return $fail('関与者１は必ず指定してください。');
                    }
                },
                new CheckDuplication($this->auth_1, $this->auth_2, $this->auth_3, $this->auth_4, $this->auth_5)  
            ],
        ];
    }
}
