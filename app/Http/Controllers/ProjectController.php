<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * @return ProjectCollection
     */
    public function index()
    {
        $projects = Project
            ::withTasksCounts()
            ->paginate(12);

        return new ProjectCollection($projects);
    }

    /**
     * @param Project $project
     * @return ProjectResource
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * @param ProjectRequest $request
     * @return array
     */
    public function store(ProjectRequest $request)
    {
        Project::create($request->validated());

        return $this->successReponse();
    }

    /**
     * @param Project $project
     * @return ProjectResource
     */
    public function edit(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * @param ProjectRequest $request
     * @param Project $project
     * @return array
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return $this->successReponse();
    }

    /**
     * @param Project $project
     * @return array
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return $this->successReponse();
    }
}
