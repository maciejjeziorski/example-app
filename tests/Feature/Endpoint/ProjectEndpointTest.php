<?php

namespace Tests\Feature\Endpoint;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectEndpointTest extends TestCase
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
        $projects = Project
            ::factory()
            ->count(5)
            ->create();

        $attributeKeys = [
            'name',
            'slug',
            'short_description',
            'client',
        ];

        $response = $this->get(
            route('projects.index')
        );

        $response->assertOk();
        $response->assertJsonFragment($projects->random()->only($attributeKeys));
        $response->assertJsonCount($projects->count(), 'data.*');
        $this->assertResponsePagination($response);
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - model's fragment is present in a JSON response's fragment
     */
    public function testShowEndpoint()
    {
        $project = Project
            ::factory()
            ->create();

        $response = $this->get(
            route('projects.show', ['project' => $project->getRouteKey()])
        );

        $response->assertOk();
        $response->assertJsonFragment($project->only(['name', 'slug', 'description', 'client']));
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - created model is present in a database
     */
    public function testStoreEndpoint()
    {
        $attributes = Project
            ::factory()
            ->make()
            ->toArray();

        $response = $this->post(
            route('projects.store'),
            $attributes
        );

        $response->assertOk();
        $this->assertDatabaseHas('projects', $attributes);
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - model's fragment is present in a JSON response's fragment
     */
    public function testEditEndpoint()
    {
        $project = Project
            ::factory()
            ->create();

        $attributeKeys = [
            'name',
            'slug',
            'description',
            'client',
        ];

        $response = $this->get(
            route('projects.edit', ['project' => $project->getRouteKey()])
        );

        $response->assertOk();
        $response->assertJsonFragment($project->only($attributeKeys));
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - updated model is present in a database
     * - previous model is not present in a database
     */
    public function testUpdateEndpoint()
    {
        $project = Project
            ::factory()
            ->create();

        $attributeKeys = [
            'name',
            'description',
            'client',
        ];

        $updatedAttributes = Project
            ::factory()
            ->make()
            ->only($attributeKeys);

        $response = $this->put(
            route('projects.update', ['project' => $project->getRouteKey()]),
            $updatedAttributes
        );

        $response->assertOk();
        $this->assertDatabaseHas('projects', $updatedAttributes);
        $this->assertDatabaseMissing('projects', $project->only($attributeKeys));
    }

    /**
     * Tests:
     * - response status is ok (code = 200)
     * - deleted model is not present in a database
     */
    public function testDestroyEndpoint()
    {
        $project = Project
            ::factory()
            ->create();

        $response = $this->delete(
            route('projects.destroy', ['project' => $project->getRouteKey()])
        );

        $response->assertOk();
        $this->assertDatabaseMissing('projects', $project->only(['id']));
    }
}
