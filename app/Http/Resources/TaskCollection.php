<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class TaskCollection extends ResourceCollection
{
    public $collects = Task::class;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(fn(Task $resource) => $resource->only([
            'title',
            'slug',
            'priority_label',
            'status_label',
            'priority_css_classes',
            'status_css_classes',
            'due_date',
        ]))->toArray();
    }

    public function with($request)
    {
        $project = $request->route('project');

        return [
            'project' => $this->when($project, new ProjectResource($project)),
        ];
    }
}
