<?php

namespace Litstack\Meta\Traits;

use Closure;
use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudUpdate;
use Ignite\Crud\Models\LitFormModel;
use Ignite\Page\Wrapper\CardWrapperComponent;
use Litstack\Meta\Metaable;
use Litstack\Meta\Models\Meta;

trait CrudHasMeta
{
    /**
     * Apply meta form to page.
     *
     * @param  CrudShow|CrudUpdate  $page
     * @param  array                $disable
     * @return CardWrapperComponent
     */
    protected function meta(CrudShow | CrudUpdate $page, array $disable = [])
    {
        $page->card(function ($form) use ($disable) {
            if ($form instanceof CrudConfig) {
                $relation = $form->relation('meta');
            } else {
                $relation = $form->oneRelation('meta')->model(Meta::class);
            }

            $relation->title('Meta')
                ->preview(function ($preview) {
                    $preview->col(fa('info').' Edit Meta Fields');
                })
                ->createAndUpdateForm(function ($form) use ($disable) {
                    if (! in_array('title', $disable)) {
                        $form->input('title')->title('Meta-Title')->hint('Ein Title sollte maximal 524 Pixel lang sein. Das entspricht in etwa 58-65 Zeichen. Eine Description sollte mindestens ca. 100 Zeichen und maximal ca. 145 Zeichen lang sein.')->max(256);
                    }
                    if (! in_array('description', $disable)) {
                        $form->input('description')->title('Meta-Description')->hint('Eine Description sollte mindestens ca. 100 Zeichen und maximal ca. 145 Zeichen lang sein. Ist eine Description kürzer als ca. 100 Zeichen, wird sie wahrscheinlich nur als eine Zeile dargestellt. Dadurch verlierst Du Platz und Aufmerksamkeit.')->max(256);
                    }
                    if (! in_array('keywords', $disable)) {
                        $form->textarea('keywords')->title('Meta-Keywords')->hint('Kommaseparierte Schlagwortliste');
                    }
                    if (! in_array('image', $disable)) {
                        // $form->image('image')->crop(1200 / 630)->expand()->title('OG Image')->hint('Vorschaubild für Facebook und Twitter verlinkungen. Damit ein Bild in der Facebook-Vorschau auch auf hochauflösenden Geräten optimal zur Geltung kommt, sollte es mindestens 1.200 x 630 Pixel groß und im Format 1,91:1 angelegt sein.')->maxFiles(1);
                    }

                    $form->component('lit-meta');
                });
        });
    }

    /**
     * Get meta title.
     *
     * @param  Metaable|LitFormModel $model
     * @return null|string
     */
    public function metaTitle(Metaable | LitFormModel $model)
    {
        if ($model instanceof Metaable) {
            return $model->metaTitle();
        } else {
            return $this->getMetaAttribute($model, 'title');
        }
    }

    /**
     * Get meta author.
     *
     * @param  Metaable|LitFormModel $model
     * @return null|string
     */
    public function metaAuthor(Metaable | LitFormModel $model)
    {
        if ($model instanceof Metaable) {
            return $model->metaAuthor();
        } else {
            return $this->getMetaAttribute($model, 'author');
        }
    }

    /**
     * Get meta description.
     *
     * @param  Metaable|LitFormModel $model
     * @return null|string
     */
    public function metaDescription(Metaable | LitFormModel $model)
    {
        if ($model instanceof Metaable) {
            return $model->metaDescription();
        } else {
            return $this->getMetaAttribute($model, 'description');
        }
    }

    /**
     * Get meta keywords.
     *
     * @param  Metaable|LitFormModel $model
     * @return null|string
     */
    public function metaKeywords(Metaable | LitFormModel $model)
    {
        if ($model instanceof Metaable) {
            return $model->metaKeywords();
        } else {
            return $this->getMetaAttribute($model, 'keywords');
        }
    }

    /**
     * Get meta image.
     *
     * @param  Metaable|LitFormModel $model
     * @return null|string
     */
    public function metaImage(Metaable | LitFormModel $model)
    {
        if ($model instanceof Metaable) {
            return $model->metaImage();
        } else {
            return $this->getMetaAttribute($model, 'image');
        }
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
    }
}
