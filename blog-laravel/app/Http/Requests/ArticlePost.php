<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePost extends FormRequest
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
            "article_title" => "required | string",
            "article_author" => "required | string",
            "section_id" => "required | integer",
            "article_hit" => "required | integer",
            "article_image" => "required | mimes:jpeg,bmp,png,gif",
            "article_content" => "required | string"
        ];
    }

    public function messages()
    {
        return [
            "article_image.mimes" => "must be an image file"
        ];
    }
}
