<?php

namespace App\Http\Requests;

use App\Flyer;
use App\Http\Requests\Request;

class FlyerPhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Flyer::where([
            'title'  => $this->title,
            'user_id' => $this->user()->id
        ])->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Validate the photo.
            'photo' => 'required|mimes:jpeg,jpg,png,bmp'
        ];
    }
}