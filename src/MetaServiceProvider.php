<?php

namespace Litstack\Meta;

use Ignite\Crud\Form;
use Ignite\Foundation\Litstack;
use Ignite\Support\Facades\Lit;
use Ignite\Crud\Api\ApiRepositories;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
{
    /**
     * Blade x components.
     *
     * @var array
     */
    protected $components = [
        'lit-meta' => Components\MetaComponent::class,
    ];

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBladeComponents();

        $this->callAfterResolving('lit.form', function (Form $form) {
            $form->field('seo', SeoField::class);
            $form->field('social', SocialField::class);
        });
        $this->callAfterResolving(ApiRepositories::class, function (ApiRepositories $rep) {
            $rep->register('meta', MetaRepository::class);
        });
        $this->callAfterResolving('lit', function(Litstack $lit) {
            $lit->script(__DIR__.'/../dist/index.js');
        });
    }

    /**
     * Boot application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'meta');

        $this->publishes([
            __DIR__.'/../config/lit-meta.php' => config_path('lit-meta.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if (! class_exists('CreateMetaTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_meta_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_meta_table.php'),
            ], 'migrations');
        }
    }

    /**
     * Register blade components.
     *
     * @return void
     */
    protected function registerBladeComponents()
    {
        foreach ($this->components as $name => $class) {
            Blade::component($name, $class);
        }
    }
}
