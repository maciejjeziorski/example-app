<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /*
     * Custom asserts below
     */
    protected function assertTableHasExpectedColumns(string $tableName, array $expectedColumns)
    {
        // Check table
        $hasTable = Schema::hasTable($tableName);

        $this->assertTrue($hasTable, "Table '{$tableName}' is not present.");

        // Check columns
        foreach ($expectedColumns as $expectedColumn) {
            $hasColumn = Schema::hasColumn($tableName, $expectedColumn);

            $this->assertTrue($hasColumn, "Column '{$expectedColumn}' is not present.");
        }
    }

    protected function assertResponsePagination(TestResponse $response)
    {
        $response->assertJsonStructure([
            'meta' => [
                'current_page',
                'last_page',
                'from',
                'to',
                'path',
                'per_page',
                'total',
                'links',
            ],
            'links' => [
                'first',
                'last',
                'next',
                'prev',
            ],
        ]);
    }
}
