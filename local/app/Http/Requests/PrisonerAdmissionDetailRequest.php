<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PrisonerAdmissionDetailRequest extends Request
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
            'prisoner_no'=>'required|string|max:250',
            'prison_id'=>'required|numeric|max:11',
            'offence'=>'required|string|max:250',
            'section_of_law'=>'required|string|max:250',
            'court_file_no'=>'required|string|max:250',
            'case_file_no'=>'required|string|max:250',
            'crb_no'=>'required|string|max:250',
            'court_id'=>'required|numeric|max:11',
            'previous_conviction_nos'=>'required|numeric|max:11',
            'marital_status'=>'required|string|max:250',
            'class_id'=>'required|numeric|max:11',
            
        ];
    }
}
