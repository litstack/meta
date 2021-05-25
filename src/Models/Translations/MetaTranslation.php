<?php

namespace Litstack\Meta\Models\Translations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Litstack\Meta\Models\Meta;

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

    /**
     * Meta relation.
     *
     * @return BelongsTo
     */
    public function meta(): BelongsTo
    {
        return $this->belongsTo(Meta::class);
    }

    public function toArray()
    {
        $array = parent::toArray();

        foreach ($this->meta->translatedAttributes as $attribute) {
            $array[$attribute] = $this->meta->metaAttribute(
                $attribute, $array[$attribute] ?? null
            );
        }

        return $array;
    }
}
