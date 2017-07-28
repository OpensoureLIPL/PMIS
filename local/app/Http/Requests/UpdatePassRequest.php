<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePassRequest extends Request
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
     *//*Regex for Password: “Atleast 1 letter, 1 number, 1 special character and SHOULD NOT start with a special character”

*/
    public function rules()
    {
        return [

        'password' => [
            'required',
            'min:6',
            'max:12',
            'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{6,12}$/',
            ],
           'new_password' => 'required|same:password',

            
        ];
    }
}
