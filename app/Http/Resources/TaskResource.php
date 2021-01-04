<?php

namespace App\Http\Resources;

use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProjectResource
 * @package App\Http\Resources
 *
 * @property-read Task $resource
 */
class TaskResource extends JsonResource
{
    protected bool $withPrioritiesConfigData = false;
    protected bool $withStatusesConfigData = false;
    protected bool $withProjectData = false;
    protected Project $project;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->only([
            'title',
            'slug',
            'description',
            'priority',
            'priority_label',
            'priority_css_classes',
            'status',
            'status_label',
            'status_css_classes',
            'due_date',
        ]);
    }

    public function withPrioritiesConfigData(): self
    {
        $this->withPrioritiesConfigData = true;

        return $this;
    }

    public function withStatusesConfigData(): self
    {
        $this->withStatusesConfigData = true;

        return $this;
    }

    public function withProjectData(Project $project): self
    {
        $this->withProjectData = true;
        $this->project = $project;

        return $this;
    }

    public function with($request)
    {
        return [
            'config_data' => $this->when($this->withPrioritiesConfigData || $this->withStatusesConfigData, [
                'priorities' => $this->when(
                    $this->withPrioritiesConfigData,
                    fn() => collect(TaskPriority::all())->map(fn($priority) => [
                        'value' => $priority,
                        'children' => __("models.task.priority.{$priority}.label")
                    ])
                ),
                'statuses' => $this->when(
                    $this->withStatusesConfigData,
                    fn() => collect(TaskStatus::all())->map(fn($status) => [
                        'value' => $status,
                        'children' => __("models.task.status.{$status}.label")
                    ])
                ),
            ]),
            'project' => $this->when(
                $this->withProjectData,
                fn() => new ProjectResource($this->project),
            )
        ];
    }
}
