<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DisabilityRequest extends Request
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
            'disability_id'=>'required|numeric|max:11',
            'prisoner_no'=>'required|string|max:250',
            /*'prison_id' => 'required|nemeric|max:11',*///may not be required
            
        ];
    }
}
