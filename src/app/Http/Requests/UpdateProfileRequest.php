<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request {

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
    public function rules() {
        return [
            'first_name' => 'max:16|min:2|alpha',
            'last_name'  => 'max:20|min:2|alpha',
            'age'        => 'between:0,120|integer',
            'summary'    => 'max:1000|min:3',
        ];
    }

}