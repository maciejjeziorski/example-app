<?php

namespace Tests\Feature\Auth;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminUserCanViewAllTasks()
    {
        $user = new User(['is_admin' => true]);

        $project = Project
            ::factory()
            ->hasTasks(5)
            ->create();

        $response = $this->actingAs($user)->get(
            route('projects.show', ['project' => $project->slug])
        );

        $response->assertJsonStructure(['data' => ['tasks']]);
    }

    public function testRegularUserCannotViewAllTasks()
    {
        $user = new User(['is_admin' => false]);

        $project = Project
            ::factory()
            ->hasTasks(5)
            ->create();

        $response = $this->actingAs($user)->get(
            route('projects.show', ['project' => $project->slug])
        );

        $jsonStructure = json_decode($response->getContent(), true);

        // Assert missing JSON structure
        $this->assertFalse(isset($jsonStructure['data']['tasks']));
    }
}
