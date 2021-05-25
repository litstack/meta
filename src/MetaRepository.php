<?php

namespace Litstack\Meta;

use Ignite\Config\ConfigHandler;
use Ignite\Crud\BaseForm;
use Ignite\Crud\Controllers\CrudBaseController;
use Ignite\Crud\CrudValidator;
use Ignite\Crud\Models\LitFormModel;
use Ignite\Crud\Repositories\BaseFieldRepository;
use Ignite\Crud\Requests\CrudReadRequest;
use Ignite\Crud\Requests\CrudUpdateRequest;
use Litstack\Meta\Models\Meta;
use Litstack\Meta\Models\Redirect;
use stdClass;

class MetaRepository extends BaseFieldRepository
{
    /**
     * Create new MetaRepository instance.
     *
     * @param ConfigHandler      $config
     * @param CrudBaseController $controller
     * @param BaseForm           $form
     * @param SeoField           $field
     */
    public function __construct($config, $controller, $form, SeoField $field)
    {
        parent::__construct($config, $controller, $form, $field);
    }

    /**
     * Get meta model.
     *
     * @param  Metaable|LitFormModel $model
     * @return Meta
     */
    protected function getMeta(Metaable | LitFormModel $model)
    {
        if ($model instanceof Metaable) {
            return $model->meta()->getResults() ?: $model->meta()->make();
        } else {
            return Meta::whereForm($model)->first();
        }
    }

    /**
     * Load list items for model.
     *
     * @param  CrudReadRequest       $request
     * @param  Metaable|LitFormModel $model
     * @return CrudJs
     */
    public function load(CrudReadRequest $request, Metaable | LitFormModel $model)
    {
        return crud($this->getMeta($model), $this->field);
    }

    /**
     * Create fowarding.
     *
     * @param  CrudUpdateRequest     $request
     * @param  Metaable|LitFormModel $model
     * @param  mixed                 $payload
     * @return void
     */
    public function forward(CrudUpdateRequest $request, Metaable | LitFormModel $model, $payload)
    {
        $route = $this->field->route;

        Redirect::create([
            'old_url' => str_replace('{slug}', $model->slug, $route),
            'new_url' => str_replace('{slug}', $payload->to, $route),
            'status'  => 301,
        ]);
    }

    /**
     * Update list item.
     *
     * @param  CrudUpdateRequest $request
     * @param  mixed             $model
     * @param  stdClass          $payload
     * @return CrudJs
     */
    public function update(CrudUpdateRequest $request, Metaable | LitFormModel $model, $payload)
    {
        CrudValidator::validate(
            (array) $payload,
            $this->field->form,
            CrudValidator::UPDATE
        );

        $attributes = $this->formatAttributes((array) $payload, $this->field->getRegisteredFields());
        $attributes['is_edited'] = true;

        $meta = $this->getMeta($model);

        $meta->update($attributes);

        return crud($meta, $this->field);
    }

    /**
     * Get child field.
     *
     * @param  string     $field_id
     * @return Field|null
     */
    public function getField($field_id)
    {
        return $this->field->form->findField($field_id);
    }
}
