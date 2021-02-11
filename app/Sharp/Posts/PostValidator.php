<?php

namespace App\Sharp\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostValidator extends FormRequest
{
    public function rules()
    {
        return [
            "title" => [
                "required",
                "max:200"
            ],
            "client" => [
                "required",
                "max:200"
            ],
            "description" => "nullable",
            "link" => "nullable",
            "publish_date" => "required|date",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Le titre est obligatoire",
            "client.required" => "Le visuel est obligatoire",
            "publish_date.required" => "La date de publication est obligatoire",
        ];
    }
}
