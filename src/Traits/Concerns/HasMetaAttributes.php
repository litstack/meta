<?php

namespace Litstack\Meta\Traits\Concerns;

use Closure;

trait HasMetaAttributes
{
    /**
     * Get meta relation.
     *
     * @param  Model $model
     * @return mixed
     */
    abstract public function getMetaRelation($model);

    /**
     * Get meta attribute.
     *
     * @param  Model  $model
     * @param  string $attribute
     * @return mixed
     */
    public function getMetaAttribute($model, $attribute)
    {
        return $this->getValueOrDefault(function () use ($attribute, $model) {
            if (property_exists($this, 'metaAttributes') &&
            array_key_exists($attribute, $this->metaAttributes)) {
                return $this->getAttribute(
                $this->metaAttributes[$attribute]
            );
            }

            return $this->getMetaRelation($model)?->{$attribute};
        }, $this->getDefaultMetaAttribute($attribute));
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
