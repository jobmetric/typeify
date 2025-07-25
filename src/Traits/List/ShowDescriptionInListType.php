<?php

namespace JobMetric\Typeify\Traits\List;

/**
 * Trait ShowDescriptionInListType
 *
 * @package JobMetric\Typeify
 */
trait ShowDescriptionInListType
{
    /**
     * Enable Show Description In List.
     *
     * @return static
     */
    public function showDescriptionInList(): static
    {
        $this->setTypeParam('show-description-in-list', true);

        return $this;
    }

    /**
     * Has Show Description In List.
     *
     * @return bool
     */
    public function hasShowDescriptionInList(): bool
    {
        return $this->getTypeParam('show-description-in-list', false);
    }
}
