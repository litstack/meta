<?php

namespace Litstack\Meta;

use Closure;
use Ignite\Crud\BaseForm;
use Ignite\Crud\Field;
use Ignite\Crud\Fields\Traits\FieldHasForm;
use Ignite\Vue\Component;
use Litstack\Meta\Models\Meta;

class SeoField extends Field
{
    use FieldHasForm;

    /**
     * Vue component name.
     *
     * @var string
     */
    protected $component = 'lit-meta';

    /**
     * Create new SeoField instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('_seo');
    }

    public function mount()
    {
        $this
            ->title('Search Engine Preview')
            ->editText('Edit website SEO')
            ->createForwardingText('Create a URL forwarding for')
            ->width(12);
    }

    public function route(string $route)
    {
        $this->setAttribute('route', $route);

        return $this;
    }

    public function title(string $title)
    {
        $this->setAttribute('title', $title);

        return $this;
    }

    public function width(int | float $width)
    {
        $this->setAttribute('width', $width);

        return $this;
    }

    public function editText($text)
    {
        $this->setAttribute('edit_text', $text);

        return $this;
    }

    public function createForwardingText(string $text)
    {
        $this->setAttribute('create_forwarding_text', $text);

        return $this;
    }

    public function setRoutePrefix($prefix)
    {
        parent::setRoutePrefix($prefix);

        $this->form(function ($form) {
            $form->input('title')->title('Pagetitle');
            $form->text('description')->title('Description');
        });
    }

    public function slug($attribute, $route, Closure $closure = null)
    {
        $this->route($route);

        $form = new BaseForm($this->formInstance->getModel());

        $form->setRoutePrefix($this->route_prefix);

        $field = $form->input($attribute)->title('Slug');

        if ($closure instanceof Closure) {
            $closure($field);
        }

        $this->setAttribute('slug_field', $field);

        return $this;
    }

    /**
     * Add form.
     *
     * @param  Closure $closure
     * @return $this
     */
    public function form(Closure $closure)
    {
        $this->setAttribute(
            'form', $form = new BaseForm(Meta::class)
        );

        $form->registered(function ($field) {
            $field->mergeOrSetAttribute('params', [
                'field_id' => $this->id,
            ]);
        });

        $form->setRoutePrefix(
            "$this->route_prefix/meta"
        );

        $closure($form);

        return $this;
    }
}
