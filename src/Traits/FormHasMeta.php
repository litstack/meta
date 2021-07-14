<?php

namespace Litstack\Meta\Traits;

use Closure;
use Ignite\Crud\Models\LitFormModel;
use Ignite\Crud\Models\Relation;
use Ignite\Support\Facades\Config;
use Litstack\Meta\Metaable;
use Litstack\Meta\Models\Meta;

trait FormHasMeta
{
    /**
     * Get meta title.
     *
     * @param  Metaable|LitFormModel $model
     * @return null|string
     */
    public function metaTitle(LitFormModel $model)
    {
        return $this->getMetaAttribute($model, 'title');
    }

    /**
     * Get meta author.
     *
     * @param  LitFormModel $model
     * @return null|string
     */
    public function metaAuthor(LitFormModel $model)
    {
        return $this->getMetaAttribute($model, 'author');
    }

    /**
     * Get meta description.
     *
     * @param  LitFormModel $model
     * @return null|string
     */
    public function metaDescription(LitFormModel $model)
    {
        return $this->getMetaAttribute($model, 'description');
    }

    /**
     * Get meta keywords.
     *
     * @param  LitFormModel $model
     * @return null|string
     */
    public function metaKeywords(LitFormModel $model)
    {
        return $this->getMetaAttribute($model, 'keywords');
    }

    /**
     * Get meta image.
     *
     * @param  LitFormModel $model
     * @return null|string
     */
    public function metaImage(LitFormModel $model)
    {
        return $this->getMetaAttribute($model, 'image');
    }

    /**
     * Get meta relation.
     *
     * @param  Model $model
     * @return mixed
     */
    public function getMetaRelation($model)
    {
        return $model->meta;
    }

    /**
     * Get meta attribute.
     *
     * @param  string $attribute
     * @return mixed
     */
    public function getMetaAttribute($model, $attribute)
    {
        return $this->getValueOrDefault(function () use ($model, $attribute) {
            if (property_exists($this, 'metaAttributes')
                && array_key_exists($attribute, $this->metaAttributes)) {
                return $model->getAttribute($this->metaAttributes[$attribute]);
            }

            return $model->meta?->{$attribute};
        }, $this->getDefaultMetaAttribute($model, $attribute));
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
    public function getDefaultMetaAttribute($model, $attribute)
    {
        if (property_exists($this, 'defaultMetaAttributes') &&
            array_key_exists($attribute, $this->defaultMetaAttributes)) {
            return $this->defaultMetaAttributes[$attribute];
        }

        $defaultMethod = 'defaultMeta'.ucfirst($attribute);

        if (method_exists($this, $defaultMethod)) {
            return $this->{$defaultMethod}($model);
        }

        return $model->getAttribute($attribute);
    }

    /**
     * Load model.
     *
     * @return Form|null
     */
    public static function load()
    {
        $model = parent::load();

        $config = Config::get(static::class);

        if ($meta = Meta::whereForm($model)->first()) {
            $model->setAttribute('meta', $meta);

            
            return $model;
        }

        $config = Config::get(static::class);
        $currentLocale = app()->getLocale();
        $locales = config('translatable.locales') ?: [app()->getLocale()];

        $attributes = [
            'model_type' => get_class($model),
            'model_id'   => $model->id,
        ];

        foreach ($locales as $locale) {
            app()->setLocale($locale);
            $attributes[$locale] = [
                'title'       => $config->metaTitle($model),
                'description' => strip_tags($config->metaDescription($model)),
                'keywords'    => $config->metaKeywords($model),
            ];
        }

        dd("s");
        $model->setAttribute('meta', Meta::create($attributes));

        app()->setLocale($currentLocale);

        return $model;
    }
}
