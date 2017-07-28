<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PrisonerRequest extends Request
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
            'prisoner_type_id'=>'required|numeric|max:11',
            'personal_no'=>'required|numeric|max:20',
            'first_name' => 'required|alpha|max:250',
            'sur_name'=>'required|alpha|max:250',
            'photo'=>'required|string|max:250',
            'gender_id'=>'required|numeric|max:11',
            'dob'=>'required|date_format:"d-m-Y"',
            'birth_place'=>'required|alpha|max:250',
            'tribe'=>'required|alpha|max:250',
            'natioanlity'=>'required|alpha|max:250',
            'finger_print'=>'required|string|max:250',
            'father_name'=>'required|alpha|max:250'
        ];
    }
}
