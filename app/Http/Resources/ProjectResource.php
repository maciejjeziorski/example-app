<?php

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProjectResource
 * @package App\Http\Resources
 *
 * @property-read Project $resource
 */
class ProjectResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'description' => $this->resource->description,
            'client' => $this->resource->client,
            'tasks' => $this->when(
                optional($request->user())->can('viewAny', Task::class),
                new TaskCollection($this->resource->tasks)
            ),
        ];
    }
}
