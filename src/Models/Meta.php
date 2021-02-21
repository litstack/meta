<?php

namespace Litstack\Meta\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Ignite\Crud\Models\Traits\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Ignite\Crud\Models\Traits\HasMedia;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;

class Meta extends Model implements TranslatableContract, HasMediaContract
{
    use HasMedia, Translatable;

    protected $table = 'meta';

    protected $translationModel = 'Litstack\Meta\Models\Translations\MetaTranslation';

    protected $fillable = [
        'title',
        'description',
        'keywords',
    ];

    /**
     * The attributes to be translated.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'description',
        'keywords',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['translations'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getImageAttribute()
    {
        return $this->getMedia('image');
    }
}
