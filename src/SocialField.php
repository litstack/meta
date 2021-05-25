<?php

namespace Litstack\Meta;

use Closure;
use Ignite\Crud\BaseForm;
use Ignite\Crud\Field;
use Ignite\Crud\Fields\Traits\FieldHasForm;
use Ignite\Vue\Component;
use Litstack\Meta\Models\Meta;

class SocialField extends Field
{
    use FieldHasForm;

    /**
     * Vue component name.
     *
     * @var string
     */
    protected $component = 'lit-meta-social';

    /**
     * Create new SeoField instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('_social');
    }

    public function mount()
    {
        $this
            ->title('Search Engine Preview')
            ->width(12);
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
