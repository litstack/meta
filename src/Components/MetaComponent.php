<?php

namespace Litstack\Meta\Components;

use Illuminate\View\Component;
use Litstack\Meta\Models\Meta;

class MetaComponent extends Component
{
    /**
     * Create new SectionDefaultComponent instance.
     *
     * @param array $slides
     */
    public function __construct(
        public array $meta
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('meta::components.meta');
    }
}
