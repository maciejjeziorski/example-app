<?php

namespace Tests\Feature;

use Tests\TestCase;

class DatabaseSchemaTest extends TestCase
{
    public function testProjectsTableHasExpectedColumns()
    {
        $this->assertTableHasExpectedColumns('projects', [
            'id',
            'name',
            'slug',
            'description',
            'client',
        ]);
    }

    public function testTasksTableHasExpectedColumns()
    {
        $this->assertTableHasExpectedColumns('tasks', [
            'id',
            'project_id',
            'title',
            'slug',
            'description',
            'priority',
            'status',
            'due_date',
        ]);
    }
}
