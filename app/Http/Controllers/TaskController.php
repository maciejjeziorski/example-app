<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * @param Project $project
     * @return TaskCollection
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks()->paginate(10);

        return new TaskCollection($tasks);
    }

    /**
     * @param Project $project
     * @param Task $task
     * @return TaskResource
     */
    public function show(Project $project, Task $task)
    {
        return (new TaskResource($task))
            ->withProjectData($project)
            ->withStatusesConfigData();
    }

    /**
     * @param Project $project
     */
    public function create(Project $project)
    {
        return (new TaskResource(new Task()))
            ->withPrioritiesConfigData()
            ->withStatusesConfigData();
    }

    /**
     * @param TaskRequest $request
     * @param Project $project
     */
    public function store(TaskRequest $request, Project $project)
    {
        $project->tasks()->create($request->validated());

        return $this->successReponse();
    }

    /**
     * @param Project $project
     * @param Task $task
     * @return TaskResource
     */
    public function edit(Project $project, Task $task)
    {
        return (new TaskResource($task))
            ->withPrioritiesConfigData()
            ->withStatusesConfigData();
    }

    /**
     * @param TaskRequest $request
     * @param Project $project
     * @param Task $task
     */
    public function update(TaskRequest $request, Project $project, Task $task)
    {
        $task->update($request->validated());

        return $this->successReponse();
    }

    /**
     * @param TaskStatusRequest $request
     * @param Project $project
     * @param Task $task
     */
    public function updateStatus(TaskStatusRequest $request, Project $project, Task $task)
    {
        $task->update($request->validated());

        return $this->successReponse();
    }

    /**
     * @param Project $project
     * @param Task $task
     * @return array
     * @throws \Exception
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return $this->successReponse();
    }
}
