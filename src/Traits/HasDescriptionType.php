<?php

namespace JobMetric\Typeify\Traits;

/**
 * Trait HasDescriptionType
 *
 * @package JobMetric\Typeify
 */
trait HasDescriptionType
{
    /**
     * Set Description.
     *
     * @param string $description
     *
     * @return static
     */
    public function description(string $description): static
    {
        $this->setTypeParam('description', $description);

        return $this;
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return trans($this->getTypeParam('description', ''));
    }
}
