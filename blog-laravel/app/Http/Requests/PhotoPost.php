<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoPost extends FormRequest
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
            "photo_name" => "required | string",
            "photo_url" => " required | mimes:jpeg,bmp,png,gif"
        ];
    }

    public function messages()
    {
        return [
            "photo_url.mimes" => "must be an image file"
        ];
    }
}
