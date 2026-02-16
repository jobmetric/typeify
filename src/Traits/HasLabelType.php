<?php

namespace JobMetric\Typeify\Traits;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait HasLabelType
 *
 * Adds label getter/setter for the current type. Label is passed to trans() when getting.
 *
 * @package JobMetric\Typeify
 */
trait HasLabelType
{
    /**
     * Set the label key for the current type (e.g. for translation).
     *
     * @param string $label Translation key or literal text
     * @return static
     * @throws TypeifyTypeNotMatchException When no type is selected
     */
    public function label(string $label): static
    {
        $this->setTypeParam('label', $label);

        return $this;
    }

    /**
     * Get the label for the current type (run through trans()).
     *
     * @return string
     * @throws TypeifyTypeNotMatchException When no type is selected
     */
    public function getLabel(): string
    {
        return trans($this->getTypeParam('label', ''));
    }
}
