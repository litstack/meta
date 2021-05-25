<?php

namespace Litstack\Meta;

use Ignite\Crud\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Metaable
{
    /**
     * Get meta title.
     *
     * @return string|null
     */
    public function metaTitle(): ?string;

    /**
     * Get meta author.
     *
     * @return string|null
     */
    public function metaAuthor(): ?string;

    /**
     * Get meta image.
     *
     * @return Media|null
     */
    public function metaImage(): ?Media;

    /**
     * Get meta keywords.
     *
     * @return string|null
     */
    public function metaKeywords(): ?string;

    /**
     * Get meta description.
     *
     * @return string|null
     */
    public function metaDescription(): ?string;

    /**
     * `meta` relation.
     *
     * @return MorphOne
     */
    public function meta(): MorphOne;
}
