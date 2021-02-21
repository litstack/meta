<?php

namespace Litstack\Meta\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Litstack\Meta\Models\Meta;

trait HasMeta
{
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'model');
    }

    public function metaTags()
    {
        return [
            'title' => $this->metaTitle()
        ];
    }

    public function metaTitle()
    {
        return $this->meta->first()->title;
    }
}
