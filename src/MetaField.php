<?php

namespace Litstack\Meta;

use Ignite\Vue\Component;

class MetaField extends Component
{
    /**
     * Vue component name.
     *
     * @var string
     */
    protected $name = 'lit-meta';

    protected $filler;

    protected $keys = [];

    public function __construct()
    {
        $this->title('Meta');
    }
}
