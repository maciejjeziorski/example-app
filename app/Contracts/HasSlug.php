<?php

namespace App\Contracts;

use Illuminate\Support\Str;

trait HasSlug
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function setSlug($value) {
        $this->attributes['slug'] = Str::slug($value);
    }
}
