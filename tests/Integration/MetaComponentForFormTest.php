<?php

namespace Tests\Integration;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Litstack\Meta\Components\MetaComponent;
use Litstack\Meta\Traits\CrudHasMeta;
use Tests\IntegrationTestCase;

class MetaComponentForFormTest extends IntegrationTestCase
{
    /** @test */
    public function test_form_with_meta_component()
    {
        $model = DummyFormConfig::load();

        $model->update([
            'foo' => 'bar',
        ]);

        $component = new MetaComponent($model);
        $this->assertSame('bar', $component->title);
    }
}

class DummyFormConfig extends FormConfig
{
    use CrudHasMeta;

    protected $metaAttributes = [
        'title' => 'foo',
    ];

    public $controller = DummyFormController::class;

    public function show(CrudShow $page)
    {
        $page->card(function ($page) {
            $page->input('foo')->translatable(false);
        });

        $this->meta($page);
    }
}

class DummyFormController
{
}
