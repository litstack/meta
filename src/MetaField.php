<?php

namespace Litstack\Meta;

use Ignite\Crud\BaseField;

class MetaField extends BaseField
{
    /**
     * Vue component name.
     *
     * @var string
     */
    protected $component = 'lit-meta';

    protected $filler;

    protected $keys = [];

    public function __construct()
    {
        $this->title('Meta');
    }
}
