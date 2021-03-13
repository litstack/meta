<?php

namespace Litstack\Meta\Components;

use Ignite\Crud\Models\LitFormModel;
use Ignite\Crud\Models\Media;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Litstack\Meta\Metaable;

class MetaComponent extends Component
{
    /**
     * Metaable instance.
     */
    public Metaable | LitFormModel $meta;

    /**
     * Create new MetaComponent instance.
     *
     * @param Metaable $meta
     */
    public function __construct(
        Metaable | LitFormModel $for,
        public ?string $title = null,
        public ?string $author = null,
        public ?string $description = null,
        public ?string $keywords = null,
        public ?Media $image = null,
    ) {
        $this->meta = $for;

        $this->setMetaAttribute('title');
        $this->setMetaAttribute('author');
        $this->setMetaAttribute('description');
        $this->setMetaAttribute('keywords');
        $this->setMetaAttribute('image');
    }

    /**
     * Set meta attribute.
     *
     * @param  string $attribute
     * @return void
     */
    protected function setMetaAttribute($attribute)
    {
        if (! \is_null($this->{$attribute})) {
            return;
        }

        $method = 'meta'.ucfirst(Str::camel($attribute));

        if ($this->meta instanceof Metaable) {
            $this->{$attribute} = $this->meta->{$method}();
        } else {
            $this->{$attribute} = $this->meta
                ->config()
                ->{$method}($this->meta);
        }
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
