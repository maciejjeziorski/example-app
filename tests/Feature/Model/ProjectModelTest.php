<?php

namespace Tests\Feature\Model;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProjectModelTest extends TestCase
{
    public function testHasRelationWithTasks()
    {
        $project = Project::factory()
            ->has(Task::factory())
            ->create();

        $this->assertInstanceOf(EloquentCollection::class, $project->tasks);
        $this->assertInstanceOf(Task::class, $project->tasks->first());
    }

    public function testHasSlugMutator()
    {
        $project = Project::factory()->make();

        $this->assertEquals(Str::slug($project->name), $project->getRouteKey());
    }
}
