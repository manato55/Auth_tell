<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckRefDuplication implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public  $_ref_1,
            $_ref_2,
            $_ref_3,
            $_ref_4;


    public function __construct($ref_1, $ref_2, $ref_3, $ref_4)
    {

        $this->_ref_1 = $ref_1;
        $this->_ref_2 = $ref_2;
        $this->_ref_3 = $ref_3;
        $this->_ref_4 = $ref_4;

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
        //Draftテーブルのカラム「ref」の数だけループ
        for($i=1;$i<5;$i++) {
            $ref = '_ref_'.$i;
            for($j=$i+1;$j<5;$j++) {
                $subref = '_ref_'.$j;
                if($this->{$ref} !== NULL && $this->{$subref} !== NULL ) {
                    
                    if($this->{$ref}->getClientOriginalName() === $this->{$subref}->getClientOriginalName()) {
                        $result[] = false;
                    } else {
                        $result[] = true;
                    }
                } else {
                    $result[] = true;
                }
            }
        }        
       
        foreach($result as $val) {
            if($val === false) {
                $error_num[] = $val;
            }
        }
       
        if(empty($error_num)) {
            $data = true;
        } else {
            $data = false;
        }
        
        return $data;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '添付された参考資料のファイルが重複してます。';
    }
}