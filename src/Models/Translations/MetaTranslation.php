<?php

namespace Litstack\Meta\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class MetaTranslation extends Model
{
    /**
     * whether the model uses the default timestamp columns.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'keywords',
    ];
}
