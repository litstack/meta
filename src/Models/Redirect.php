<?php

namespace Litstack\Meta\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect as RedirectFacade;
use InvalidArgumentException;

class Redirect extends Model
{
    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'redirects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'old_url', 'new_url', 'status',
    ];

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            if (trim(strtolower($model->old_url), '/') == trim(strtolower($model->new_url), '/')) {
                throw new InvalidArgumentException('The old url cannot be the same as the new url: '.$model->new_url);
            }

            static::whereOldUrl($model->new_url)->whereNewUrl($model->old_url)->delete();

            $model->syncOldRedirects($model, $model->new_url);

            Cache::forget('lit.redirects');
        });
    }

    /**
     * The mutator to set the "old_url" attribute.
     *
     * @param string $value
     */
    public function setOldUrlAttribute($value)
    {
        $this->attributes['old_url'] = trim(parse_url($value)['path'], '/');
    }

    /**
     * The mutator to set the "new_url" attribute.
     *
     * @param string $value
     */
    public function setNewUrlAttribute($value)
    {
        $this->attributes['new_url'] = trim(parse_url($value)['path'], '/');
    }

    /**
     * Filter the query by an old url.
     *
     * @param Builder $query
     * @param string  $url
     *
     * @return mixed
     */
    public function scopeWhereOldUrl($query, string $url)
    {
        return $query->where('old_url', $url);
    }

    /**
     * Filter the query by a new url.
     *
     * @param Builder $query
     * @param string  $url
     *
     * @return mixed
     */
    public function scopeWhereNewUrl($query, string $url)
    {
        return $query->where('new_url', $url);
    }

    /**
     * Sync old redirects to point to the new (final) url.
     *
     * @param  self   $redirect
     * @param  string $finalUrl
     * @return void
     */
    public function syncOldRedirects(self $redirect, string $finalUrl): void
    {
        $items = static::whereNewUrl($redirect->old_url)->get();

        foreach ($items as $item) {
            $item->update(['new_url' => $finalUrl]);
            $item->syncOldRedirects($redirect, $finalUrl);
        }
    }

    /**
     * Return a valid redirect entity for a given path (old url).
     * A redirect is valid if:
     * - it has an url to redirect to (new url)
     * - it's status code is one of the statuses defined on this model.
     *
     * @param  string              $path
     * @return RedirectFacade|null
     */
    public static function findValidOrNull($path): ?self
    {
        return static::where('old_url', $path === '/' ? $path : trim($path, '/'))
            ->whereNotNull('new_url')
            ->latest()->first();
    }
}
