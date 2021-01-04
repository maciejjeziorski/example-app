<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = ucwords($this->faker->unique()->words(rand(2, 3), true)) . ' project',
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(rand(1, 3), true),
            'client' => $this->faker->name,
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
                'client' => $this->optional($attributes['client']),
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
