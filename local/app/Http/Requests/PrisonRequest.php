<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PrisonRequest extends Request
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

            'prison_name' => 'required|alpha|max:250',
            'phone_no'=>'numeric|max:20',
            'prison_type_id'=>'required|numeric|max:11',
            'prison_code'=>'required|alpha|max:250',
            'capacity'=>'required|numeric'
            'opening_date'=>'required|date_format:"d-m-Y"',
            'security_level_id'=>'required|numeric|max:11',
            'physical_address'=>'required|string'
        ];
    }
}
