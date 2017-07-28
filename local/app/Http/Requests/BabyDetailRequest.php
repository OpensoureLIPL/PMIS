<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
  
class BabyDetailRequest extends Request
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
            'prisoner_no' => 'required|string|max:250',
            'baby_name'=>'required|alpha|max:250',
            'dob'=>'required|date_format:"d-m-Y"',
            'father_name'=>'required|alpha|max:250',
            'birth_place'=>'required|alpha|max:250',
            'gender_id'=>'required|numeric|max:11',
        ];
    }
}
