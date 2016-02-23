<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TravelFlyersRequest extends Request {

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
            'title'       => 'required|max:75|min:3',
            'excerpt'     => 'required|max:250|min:10',
            'description' => 'required|max:3000|min:10',
            'location'    => 'required|max:100|min:3',
            'lat'         => 'required',
            'lng'         => 'required',
        ];
    }

}