<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:categories,slug',
            'quote' => 'nullable|string',
            'post_image' => 'required|image|max:2048',
            'description' => 'required|min:20',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'status' => 'required|in:0,1',
            'tag_ids' => 'required|array',

        ];
    }
}
