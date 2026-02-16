<?php

namespace JobMetric\Typeify\Traits;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait HasDescriptionType
 *
 * Adds description getter/setter for the current type. Description is passed to trans() when getting.
 *
 * @package JobMetric\Typeify
 */
trait HasDescriptionType
{
    /**
     * Set the description key for the current type (e.g. for translation).
     *
     * @param string $description Translation key or literal text
     * @return static
     * @throws TypeifyTypeNotMatchException When no type is selected
     */
    public function description(string $description): static
    {
        $this->setTypeParam('description', $description);

        return $this;
    }

    /**
     * Get the description for the current type (run through trans()).
     *
     * @return string
     * @throws TypeifyTypeNotMatchException When no type is selected
     */
    public function getDescription(): string
    {
        return trans($this->getTypeParam('description', ''));
    }
}
