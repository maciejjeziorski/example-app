<?php

namespace Database\Factories;

use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'title' => $title = trim($this->faker->unique()->sentence, '.'),
            'slug' => Str::slug($title),
            'description' => $this->faker->sentences(rand(1, 5), true),
            'priority' => $this->faker->randomElement(TaskPriority::all()),
            'status' => $this->faker->randomElement(TaskStatus::all()),
            'due_date' => $this->faker->dateTimeBetween('-5 days', '+30 days')->format('Y-m-d'),
        ];
    }

    /**
     * @return Factory
     */
    public function withOptionalFields()
    {
        return $this->state(function (array $attributes) {
            return [
                'description' => $this->optional($attributes['description']),
                'due_date' => $this->optional($attributes['due_date']),
            ];
        });
    }

    /**
     * @param mixed $value
     * @return mixed|null
     */
    private function optional($value)
    {
        return rand(0, 1) ? $value : null;
    }
}
