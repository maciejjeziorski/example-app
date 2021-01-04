<?php

use App\Enum\TaskPriority;
use App\Enum\TaskStatus;

return [

    /*
    |--------------------------------------------------------------------------
    | Model translations
    |--------------------------------------------------------------------------
    */

    'project' => [],
    'task' => [
        'priority' => [
            TaskPriority::LOW => [
                'label' => 'Low',
                'css_classes' => 'bg-light text-dark',
            ],
            TaskPriority::NORMAL => [
                'label' => 'Normal',
                'css_classes' => 'bg-warning text-dark',
            ],
            TaskPriority::HIGH => [
                'label' => 'High',
                'css_classes' => 'bg-danger',
            ],
        ],
        'status' => [
            TaskStatus::NOT_STARTED => [
                'label' => 'Not started',
                'css_classes' => 'bg-light text-dark',
            ],
            TaskStatus::IN_PROGRESS => [
                'label' => 'In progress',
                'css_classes' => 'bg-primary',
            ],
            TaskStatus::COMPLETED => [
                'label' => 'Completed',
                'css_classes' => 'bg-dark',
            ],
        ],
    ],
];
