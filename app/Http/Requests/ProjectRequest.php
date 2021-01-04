<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $exceptProjectId = optional(request()->route('project'))->id ?: 0;

        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:50',
                "unique:projects,name,{$exceptProjectId}"
            ],
            'description' => [
                'nullable',
                'string',
                'min:10',
                'max:1000',
            ],
            'client' => [
                'nullable',
                'string',
                'min:5',
                'max:30',
            ],
        ];
    }
}
