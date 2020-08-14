<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckDuplication implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public  $_auth_1,
            $_auth_2,
            $_auth_3,
            $_auth_4,
            $_auth_5;


    public function __construct($auth_1, $auth_2, $auth_3, $auth_4, $auth_5)
    {

        $this->_auth_1 = $auth_1;
        $this->_auth_2 = $auth_2;
        $this->_auth_3 = $auth_3;
        $this->_auth_4 = $auth_4;
        $this->_auth_5 = $auth_5;

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
        //Draftテーブルのカラム「auth」の数だけループ
        for($i=1;$i<6;$i++) {
            $auth = '_auth_'.$i;
            for($j=$i+1;$j<6;$j++) {
                $subAuth = '_auth_'.$j;
                if($this->{$auth} === '---' || $this->{$auth} === null) {
                    $this->{$auth} = 'escape_duplication';
                }
                if($this->{$auth} === $this->{$subAuth}) {
                    return false;
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
        return '関与者が重複してます。';
    }
}
