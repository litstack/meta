<?php

namespace Litstack\Meta\Lit;

use Ignite\Crud\CrudShow;
use Ignite\Crud\CrudIndex;
use Litstack\Meta\Models\Meta;
use Ignite\Crud\Config\CrudConfig;
use Litstack\Meta\Lit\MetaController;

class MetaConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Meta::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = MetaController::class;

    /**
     * Model singular and plural name.
     *
     * @param Meta|null meta
     * @return array
     */
    public function names(Meta $meta = null)
    {
        return [
            'singular' => 'Meta',
            'plural'   => 'Meta',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'meta';
    }

    /**
     * Build index page.
     *
     * @param  \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->table(function ($table) {
            $table->col('Title')->value('{title}')->sortBy('title');
        })->search('title');
    }

    /**
     * Setup show page.
     *
     * @param  \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->card(function ($form) {
            $form->input('title');
        });
    }
}
