<?php

namespace Litstack\Meta\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Ignite\Crud\Models\LitFormModel;
use Ignite\Crud\Models\Traits\HasMedia;
use Ignite\Crud\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Litstack\Meta\Metaable;
use Litstack\Meta\Models\Translations\MetaTranslation;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;

class Meta extends Model implements TranslatableContract, HasMediaContract
{
    use HasMedia, Translatable;

    /**
     * Database table name.
     *
     * @var string
     */
    protected $table = 'meta';

    /**
     * Translation model.
     *
     * @var string
     */
    protected $translationModel = MetaTranslation::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_type', 'model_id', 'is_edited',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_edited' => 'boolean',
    ];

    /**
     * Default model attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_edited' => false,
    ];

    /**
     * The attributes to be translated.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title', 'description', 'keywords',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['translations'];

    public static function booting(): void
    {
        static::saving(function (self $model) {
            if (! $model->isDirty('is_edited') || ! $model->is_edited) {
                return;
            }

            $model->is_edited = false;

            $currentLocale = app()->getLocale();
            $locales = config('translatable.locales') ?: [app()->getLocale()];

            foreach ($locales as $locale) {
                app()->setLocale($locale);

                foreach ($model->translatedAttributes as $attribute) {
                    $value = $model->getAttributeOrFallback($locale, $attribute);
                    $original = $model->getAttribute($attribute);

                    unset($model[$attribute]);

                    if ($value == $original) {
                        continue;
                    }

                    if (! empty($value)) {
                        continue;
                    }

                    $model->getTranslation($locale)->setAttribute($attribute, $original);
                }
            }

            $model->is_edited = true;

            app()->setLocale($currentLocale);
        });
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeWhereForm($query, LitFormModel $form)
    {
        $query
            ->where('model_type', get_class($form))
            ->where('model_id', $form->id);
    }

    public function getImageAttribute()
    {
        return $this->getMedia('image') ?: $this->metaAttribute('image', null);
    }

    /**
     * Get `title` attribute.
     *
     * @param  string $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return $this->metaAttributeIfEdited('title', $value);
    }

    /**
     * Get `description` attribute.
     *
     * @param  string $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return $this->metaAttributeIfEdited('description', $value);
    }

    /**
     * Get `keywords` attribute.
     *
     * @param  string $value
     * @return string
     */
    public function getKeywordsAttribute($value)
    {
        return $this->metaAttributeIfEdited('keywords', $value);
    }

    /**
     * Get meta attribute.
     *
     * @param  string $attribute
     * @param  string $value
     * @return mixed
     */
    public function metaAttribute($attribute, $value = null)
    {
        $method = 'meta'.ucfirst(Str::camel($attribute));

        if ($this->model instanceof LitFormModel) {
            $value = $this->model->config->{$method}($this->model);
        } elseif ($this->model instanceof Metaable) {
            $value = $this->model->{$method}();
        }

        if ($this->hasMetaMutator($attribute)) {
            return $this->mutateMetaAttribute($attribute, $value);
        }

        return $value;
    }

    public function metaAttributeIfEdited($attribute, $value)
    {
        return $this->is_edited
            ? $value
            : $this->metaAttribute($attribute, $value);
    }

    public function hasMetaMutator($attribute)
    {
        return method_exists($this, $this->getMetaMutatorMethod($attribute));
    }

    protected function getMetaMutatorMethod($attribute)
    {
        return 'mutateMeta'.ucfirst(Str::camel($attribute));
    }

    public function mutateMetaAttribute($attribute, $value)
    {
        return call_user_func_array([
            $this, $this->getMetaMutatorMethod($attribute),
        ], [$value]);
    }

    public function mutateMetaDescription($value)
    {
        // Replace tags with spaces:
        $stripped = preg_replace('#<[^>]+>#', ' ', $value);

        // Replace multiple whitespaces:
        return trim(preg_replace('/\s+/', ' ', $stripped), ' ');
    }

    public function getTranslationsArray(): array
    {
        $translations = [];

        $currentLocale = app()->getLocale();

        foreach ($this->translations as $translation) {
            foreach ($this->translatedAttributes as $attr) {
                $locale = $translation->{$this->getLocaleKey()};

                app()->setLocale($locale);

                $value = $translation->{$attr};

                if (! $this->is_edited) {
                    $value = $this->metaAttribute($attr, $value);
                }

                $translations[$locale][$attr] = $value;
            }
        }

        app()->setLocale($currentLocale);

        return $translations;
    }
}
