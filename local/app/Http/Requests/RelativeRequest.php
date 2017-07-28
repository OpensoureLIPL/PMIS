<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RelativeRequest extends Request
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
            'first_name' => 'required|alpha|max:250',
            'sur_name'=>'required|alpha|max:250',
            'contact_no'=>'required|numeric|max:20',
            'relation_id'=>'required|numeric|max:11',
            'birth_place'=>'required|alpha|max:250',
            'gender_id'=>'required|numeric|max:11',
            'physical_address'=>'required|string'
        ];
    }
}
