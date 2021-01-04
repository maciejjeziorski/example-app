<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    public $collects = Project::class;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(fn(Project $project) => $project->only([
            'name',
            'slug',
            'short_description',
            'client',
            'tasks_count',
            'completed_tasks_count',
        ]))->toArray();
    }
}
