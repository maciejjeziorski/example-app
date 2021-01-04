<?php

namespace App\Models;

use App\Contracts\HasSlug;
use App\Enum\TaskStatus;
use Carbon\Carbon;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Project
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $client
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read EloquentCollection $tasks
 * @property-read string|null $short_description
 *
 * @method static ProjectFactory factory()
 * @method static Builder withTasksCounts()
 */
class Project extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'description',
        'client'
    ];

    /**
     * Project-Tasks
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Mutator: name, slug
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $this->setSlug($value);
    }

    /**
     * Accessor: short_description
     *
     * @return string
     */
    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 100);
    }

    /**
     * Scope: withTasksCounts
     *
     * @param Builder $query
     */
    public function scopeWithTasksCounts(Builder $query): Builder
    {
        return $query->withCount([
            'tasks as tasks_count',
            'tasks as completed_tasks_count' => function (Builder $query) {
                $query->where('status', TaskStatus::COMPLETED);
            },
        ]);
    }
}
