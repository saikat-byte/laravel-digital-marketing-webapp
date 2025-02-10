<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:text,rich_text,image,multi_image,video,file,link,map,custom'],
            'code' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'status' => ['boolean'],
            'description' => ['nullable', 'string'],
            'settings' => ['nullable', 'array'],
            'settings.*' => ['nullable'],
        ];

        if ($this->isMethod('POST')) {
            $rules['code'][] = 'unique:page_sections';
        } else {
            $rules['code'][] = 'unique:page_sections,code,' . $this->route('section')->id;
        }

        return $rules;
    }
}
