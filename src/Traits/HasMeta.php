<?php

namespace Litstack\Meta\Traits;

use Closure;
use Ignite\Crud\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Litstack\Meta\Models\Meta;

trait HasMeta
{
    /**
     * `meta` relation.
     *
     * @return MorphOne
     */
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'model');
    }

    /**
     * Get meta title.
     *
     * @return string|null
     */
    public function metaTitle(): ?string
    {
        return $this->getMetaAttribute('title');
    }

    /**
     * Get meta author.
     *
     * @return string|null
     */
    public function metaAuthor(): ?string
    {
        return $this->getMetaAttribute('author');
    }

    /**
     * Get meta image.
     *
     * @return Media|null
     */
    public function metaImage(): ?Media
    {
        return $this->getMetaAttribute('image');
    }

    /**
     * Get meta description.
     *
     * @return string|null
     */
    public function metaDescription(): ?string
    {
        return $this->getMetaAttribute('description');
    }

    /**
     * Get meta keywords.
     *
     * @return string|null
     */
    public function metaKeywords(): ?string
    {
        return $this->getMetaAttribute('keywords');
    }

    /**
     * Get meta attribute.
     *
     * @param  string $attribute
     * @return mixed
     */
    public function getMetaAttribute($attribute)
    {
        return $this->getValueOrDefault(function () use ($attribute) {
            if (property_exists($this, 'metaAttributes')
                && array_key_exists($attribute, $this->metaAttributes)) {
                return $this->getDottedAttribute($this->metaAttributes[$attribute]);
            }

            if (! $this->relationLoaded('meta')) {
                $this->load('meta');
            }

            return $this->getRelation('meta')?->{$attribute};
        }, $this->getDefaultMetaAttribute($attribute));
    }

    /**
     * Get dotted attribute.
     *
     * @param  string $key
     * @return mixed
     */
    public function getDottedAttribute($key)
    {
        if (! Str::contains($key, '.')) {
            return $this->getAttribute($key);
        }

        $keys = explode('.', $key);
        $value = $this->getAttribute(array_shift($keys));

        foreach ($keys as $key) {
            if (! $value) {
                return;
            }

            $value = $value->{$key};
        }

        return $value;
    }

    /**
     * Return value or default.
     *
     * @param  Closure $closure
     * @param  mixed   $default
     * @return mixed
     */
    protected function getValueOrDefault(Closure $closure, $default)
    {
        return $closure() ?: $default;
    }

    /**
     * Get the default meta attribute.
     *
     * @param  string $attribute
     * @return void
     */
    public function getDefaultMetaAttribute($attribute)
    {
        if (property_exists($this, 'defaultMetaAttributes') &&
            array_key_exists($attribute, $this->defaultMetaAttributes)) {
            return $this->defaultMetaAttributes[$attribute];
        }

        $defaultMethod = 'defaultMeta'.ucfirst($attribute);
        if (method_exists($this, $defaultMethod)) {
            return $this->{$defaultMethod}();
        }
    }
}
