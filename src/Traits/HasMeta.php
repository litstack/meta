<?php

namespace Litstack\Meta\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Litstack\Meta\Models\Meta;

trait HasMeta
{
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'model');
    }

    public function metaFields(): array
    {
        return [
            'title'       => $this->meta->title,
            'description' => $this->meta->tescription,
            'keywords'    => $this->meta->teywords,
            'image'       => $this->meta->image,
        ];
    }
}
