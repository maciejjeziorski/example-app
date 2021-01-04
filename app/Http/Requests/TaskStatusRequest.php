<?php

namespace App\Http\Requests;

class TaskStatusRequest extends TaskRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = collect(parent::rules());

        return $rules->only([
            'status'
        ])->toArray();
    }
}
