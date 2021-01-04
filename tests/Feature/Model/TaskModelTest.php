<?php

namespace Tests\Feature\Model;

use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    public function testHasRelationWithProject()
    {
        $task = Task::factory()
            ->for(Project::factory())
            ->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

    public function testHasAdditionalAccessors()
    {
        $task = Task::factory()->make();

        $this->assertNotEmpty($task->priority_label);
        $this->assertNotEmpty($task->priority_css_classes);
        $this->assertNotEmpty($task->status_label);
        $this->assertNotEmpty($task->status_css_classes);
    }

    public function testHasSlugMutator()
    {
        $task = Task::factory()->make();

        $this->assertEquals(Str::slug($task->title), $task->getRouteKey());
    }

    public function testHasDefaultAttributes()
    {
        $task = new Task();

        $this->assertEquals(TaskPriority::LOW, $task->priority);
        $this->assertEquals(TaskStatus::NOT_STARTED, $task->status);
    }
}
