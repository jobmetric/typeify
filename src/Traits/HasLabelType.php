<?php

namespace JobMetric\Typeify\Traits;

/**
 * Trait HasLabelType
 *
 * @package JobMetric\Typeify
 */
trait HasLabelType
{
    /**
     * Set Label.
     *
     * @param string $label
     *
     * @return static
     */
    public function label(string $label): static
    {
        $this->setTypeParam('label', $label);

        return $this;
    }

    /**
     * Get Label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return trans($this->getTypeParam('label', ''));
    }
}
