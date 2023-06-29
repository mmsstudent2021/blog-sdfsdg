<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            "title" => "required|min:10|max:255",
            "description" => "required|min:100",
            "category" => "required|exists:categories,id",
            "thumbnail" => "nullable|file|max:500|min:50|mimes:png,jpg",
            "photos" => "required|array|max:3",
            "photos.*" => "file|max:500|min:50|mimes:png,jpg",
            "tags" => "nullable|array|max:3",
            "tags.*" => "exists:tags,id"
        ];
    }
}
