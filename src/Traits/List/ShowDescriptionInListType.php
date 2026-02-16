<?php

namespace JobMetric\Typeify\Traits\List;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait ShowDescriptionInListType
 *
 * Adds "show description in list" flag for the current type (enable / check).
 *
 * @package JobMetric\Typeify
 */
trait ShowDescriptionInListType
{
    /**
     * Enable show-description-in-list for the current type.
     *
     * @return static
     * @throws TypeifyTypeNotMatchException
     */
    public function showDescriptionInList(): static
    {
        $this->setTypeParam('show-description-in-list', true);

        return $this;
    }

    /**
     * Whether show-description-in-list is enabled for the current type.
     *
     * @return bool
     * @throws TypeifyTypeNotMatchException
     */
    public function hasShowDescriptionInList(): bool
    {
        return $this->getTypeParam('show-description-in-list', false);
    }
}
