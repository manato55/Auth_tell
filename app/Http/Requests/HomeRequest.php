<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckDuplication;

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

    
    public function rules()
    {
        return [
            'title' => 'required|max:30', 
            'registered_date' => 'required', 
            'explanation' => 'required|max:400',
            'file_1' => [
                'file',
            ],
            'auth_1' => [
                function ($attribute, $value, $fail) {
                    if ($value === '---') {
                      return $fail('関与者１は必ず指定してください。');
                    }
                },
                new CheckDuplication
                (
                    $this->auth_1, 
                    $this->auth_2,
                    $this->auth_3,
                    $this->auth_4,
                    $this->auth_5,
                )  
            ],
        ];
    }
}
