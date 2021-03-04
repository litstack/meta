<?php

namespace Litstack\Meta\Components;

use Ignite\Crud\Models\Media;
use Illuminate\View\Component;
use Litstack\Meta\Metaable;

class MetaComponent extends Component
{
    /**
     * Metaable instance.
     */
    public Metaable $meta;

    /**
     * Create new MetaComponent instance.
     *
     * @param Metaable $meta
     */
    public function __construct(
        Metaable $for,
        public ?string $title = null,
        public ?string $author = null,
        public ?string $description = null,
        public ?string $keywords = null,
        public ?Media $image = null,
    ) {
        $this->meta = $for;

        if (\is_null($this->title)) {
            $this->title = $this->meta->metaTitle();
        }
        if (\is_null($this->author)) {
            $this->author = $this->meta->metaTitle();
        }
        if (\is_null($this->description)) {
            $this->title = $this->meta->metaDescription();
        }
        if (\is_null($this->keywords)) {
            $this->title = $this->meta->metaKeywords();
        }
        if (\is_null($this->image)) {
            $this->title = $this->meta->metaImage();
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
