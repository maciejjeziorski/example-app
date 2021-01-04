<?php

namespace Tests\Feature\Endpoint;

use App\Enum\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskEndpointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - random model's fragment is present in a JSON response
     * - models' count in a response is equal to created models' count
     * - response returns a pagination metadata
     */
    public function testIndexEndpoint()
    {
        $tasks = Task
            ::factory()
            ->for($project = Project::factory()->create())
            ->count(5)
            ->create();

        $attributeKeys = [
            'title',
            'slug',
            'priority_label',
            'status_label',
            'priority_css_classes',
            'status_css_classes',
            'due_date',
        ];

        $response = $this->get(
            route('tasks.index', ['project' => $project->getRouteKey()])
        );

        $response->assertOk();
        $response->assertJsonFragment($tasks->random()->only($attributeKeys));
        $response->assertJsonCount($tasks->count(), 'data.*');
        $this->assertResponsePagination($response);
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - model's fragment is present in a JSON response's fragment
     */
    public function testShowEndpoint()
    {
        $task = Task
            ::factory()
            ->create();

        $attributeKeys = [
            'title',
            'slug',
            'description',
            'priority',
            'status',
            'priority_label',
            'status_label',
            'priority_css_classes',
            'status_css_classes',
            'due_date',
        ];

        $response = $this->get(
            route('tasks.show', ['project' => $task->project->getRouteKey(), 'task' => $task->getRouteKey()])
        );

        $response->assertOk();
        $response->assertJsonFragment($task->only($attributeKeys));
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - created model is present in a database
     */
    public function testStoreEndpoint()
    {
        $task = Task
            ::factory()
            ->make();

        $attributesKeys = [
            'title',
            'description',
            'priority',
            'status',
            'due_date',
        ];

        $response = $this->post(
            route('tasks.store', ['project' => $task->project->getRouteKey()]),
            $task->only($attributesKeys)
        );
        $response->assertOk();

        $this->assertDatabaseHas('tasks', $task->only($attributesKeys));
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - model's fragment is present in a JSON response's fragment
     */
    public function testEditEndpoint()
    {
        $task = Task
            ::factory()
            ->create();

        $attributeKeys = [
            'title',
            'slug',
            'description',
            'priority',
            'status',
            'due_date',
        ];

        $response = $this->get(
            route('tasks.edit', ['project' => $task->project->getRouteKey(), 'task' => $task->getRouteKey()])
        );

        $response->assertOk();
        $response->assertJsonFragment($task->only($attributeKeys));
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - updated model is present in a database
     * - previous model is not present in a database
     */
    public function testUpdateEndpoint()
    {
        $task = Task
            ::factory()
            ->create();

        $attributeKeys = [
            'title',
            'description',
            'priority',
            'status',
            'due_date',
        ];

        $updatedAttributes = Task
            ::factory()
            ->make()
            ->only($attributeKeys);

        $response = $this->put(
            route('tasks.update', ['project' => $task->project->getRouteKey(), 'task' => $task->getRouteKey()]),
            $updatedAttributes
        );

        $response->assertOk();
        $this->assertDatabaseHas('tasks', $updatedAttributes);
        $this->assertDatabaseMissing('tasks', $task->only($attributeKeys));
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - updated status is present in a database
     * - previous status is not present in a database
     */
    public function testUpdateStatusEndpoint()
    {
        $oldAttributes = ['status' => TaskStatus::NOT_STARTED];
        $newAttributes = ['status' => TaskStatus::COMPLETED];

        $task = Task
            ::factory()
            ->state($oldAttributes)
            ->create();

        $response = $this->patch(
            route('tasks.update_status', ['project' => $task->project->getRouteKey(), 'task' => $task->getRouteKey()]),
            $newAttributes
        );

        $response->assertOk();
        $this->assertDatabaseHas('tasks', $newAttributes);
        $this->assertDatabaseMissing('tasks', $oldAttributes);
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - deleted model is not present in a database
     */
    public function testDestroyEndpoint()
    {
        $task = Task
            ::factory()
            ->create();

        $this->assertDatabaseHas('tasks', $task->only(['id']));

        $response = $this->delete(
            route('tasks.destroy', ['project' => $task->project->getRouteKey(), 'task' => $task->getRouteKey()])
        );

        $response->assertOk();
        $this->assertDatabaseMissing('tasks', $task->only(['id']));
    }
}
