<?php

namespace App\Http\Requests;

use App\User;
use App\Http\Requests\Request;

class AddProfilePhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where([
            'username'  => $this->username,
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