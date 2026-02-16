<?php

namespace JobMetric\Typeify\Traits\List;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait RemoveFilterInListType
 *
 * Adds "remove filter in list" flag for the current type (enable / check).
 *
 * @package JobMetric\Typeify
 */
trait RemoveFilterInListType
{
    /**
     * Enable remove-filter-in-list for the current type.
     *
     * @return static
     * @throws TypeifyTypeNotMatchException
     */
    public function removeFilterInList(): static
    {
        $this->setTypeParam('remove-filter-in-list', true);

        return $this;
    }

    /**
     * Whether remove-filter-in-list is enabled for the current type.
     *
     * @return bool
     * @throws TypeifyTypeNotMatchException
     */
    public function hasRemoveFilterInList(): bool
    {
        return $this->getTypeParam('remove-filter-in-list', false);
    }
}
