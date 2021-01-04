<?php

namespace App\Models;

use App\Contracts\HasSlug;
use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class Task
 * @package App\Models
 *
 * @property int $id
 * @property int $project_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $priority (\App\Enum\TaskPriority enum)
 * @property string $status (\App\Enum\TaskStatus enum)
 * @property Carbon $due_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Project $project
 * @property-read string $priority_label
 * @property-read string $priority_css_classes
 * @property-read string $status_label
 * @property-read string $status_css_classes
 *
 * @method static TaskFactory factory()
 */
class Task extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'priority',
        'status',
        'due_date'
    ];

    protected $attributes = [
        'priority' => TaskPriority::LOW,
        'status' => TaskStatus::NOT_STARTED,
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Mutator: title, slug
     *
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $this->setSlug($value);
    }

    public function getPriorityLabelAttribute(): string
    {
        return __("models.task.priority.{$this->priority}.label");
    }

    public function getPriorityCssClassesAttribute(): string
    {
        return __("models.task.priority.{$this->priority}.css_classes");
    }

    public function getStatusLabelAttribute(): string
    {
        return __("models.task.status.{$this->status}.label");
    }

    public function getStatusCssClassesAttribute(): string
    {
        return __("models.task.status.{$this->status}.css_classes");
    }
}
