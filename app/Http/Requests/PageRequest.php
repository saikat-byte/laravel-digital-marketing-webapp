<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['boolean'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'meta_keywords' => ['nullable', 'string'],
            'og_title' => ['nullable', 'string', 'max:60'],
            'og_description' => ['nullable', 'string'],
            'og_image' => ['nullable', 'image', 'max:2048'],
            'twitter_card' => ['nullable', 'string'],
            'twitter_title' => ['nullable', 'string'],
            'twitter_description' => ['nullable', 'string'],
            'twitter_image' => ['nullable', 'image', 'max:2048'],
            'canonical_url' => ['nullable', 'url'],
        ];

        if ($this->isMethod('POST')) {
            $rules['name'][] = 'unique:pages';
        } else {
            $rules['name'][] = 'unique:pages,name,' . $this->route('page')->id;
        }

        return $rules;
    }
}
