<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProjectResource
 * @package App\Http\Resources
 *
 * @property-read Project $resource
 */
class ProjectResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->only([
            'name',
            'slug',
            'description',
            'client',
        ]);
    }
}
