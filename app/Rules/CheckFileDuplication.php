<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class CheckFileDuplication implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public  $_file_1,
            $_file_2,
            $_file_3,
            $_file_4;


    public function __construct($file_1, $file_2, $file_3, $file_4)
    {
        $this->_file_1 = $file_1;
        $this->_file_2 = $file_2;
        $this->_file_3 = $file_3;
        $this->_file_4 = $file_4;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Draftテーブルのカラム「file」の数だけループ
        for($i=1;$i<5;$i++) {
            $file = '_file_'.$i;
            for($j=$i+1;$j<5;$j++) {
                $subfile = '_file_'.$j;
                if($this->{$file} !== NULL && $this->{$subfile} !== NULL ) {
                    if($this->{$file}->getClientOriginalName() === $this->{$subfile}->getClientOriginalName()) {
                        return false;
                    } 
                } 
            }
        }        
        
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '添付された依頼文等のファイルが重複してます。';
    }
}