<?php

namespace App\Http\Requests;

use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $priorities = implode(',', TaskPriority::all());
        $statuses = implode(',', TaskStatus::all());
        $exceptTaskId = optional(request()->route('task'))->id ?: 0;
        $projectId = request()->route('project')->id;

        return [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:100',
                Rule::unique('tasks')
                    ->ignore($exceptTaskId)
                    ->where(function (Builder $query) use ($projectId) {
                        return $query->where('project_id', $projectId);
                    }),
            ],
            'description' => [
                'nullable',
                'string',
                'min:10',
                'max:1000',
            ],
            'priority' => [
                'required',
                "in:{$priorities}"
            ],
            'status' => [
                'required',
                "in:{$statuses}"
            ],
            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:-1 year',
                'before:+1 year'
            ],
        ];
    }
}
