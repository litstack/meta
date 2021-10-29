<?php

namespace Litstack\Meta;

class MetaObserver
{
    /**
     * Handle the Metaable "created" event.
     *
     * @param  Metaable $metaable
     * @return void
     */
    public function created(Metaable $metaable)
    {
        $this->createMeta($metaable);
    }

    /**
     * Handle the Metaable "retrieved" event.
     *
     * @param Metaable $metaable
     * @return void
     */
    public function retrieved(Metaable $metaable)
    {
        if ($metaable->meta()->exists()) {
            return;
        }
        $this->createMeta($metaable);
    }

    public function createMeta(Metaable $metaable)
    {
        $currentLocale = app()->getLocale();
        $locales = config('translatable.locales') ?: [app()->getLocale()];

        $attributes = [];

        foreach ($locales as $locale) {
            app()->setLocale($locale);
            $attributes[$locale] = [
                'title'       => $metaable->metaTitle(),
                'description' => strip_tags($metaable->metaDescription()),
                'keywords'    => $metaable->metaKeywords(),
            ];
        }

        $metaable->meta()->create($attributes);

        app()->setLocale($currentLocale);
    }
}
