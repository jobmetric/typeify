<?php

namespace JobMetric\Typeify\Traits\List;

/**
 * Trait RemoveFilterInListType
 *
 * @package JobMetric\Typeify
 */
trait RemoveFilterInListType
{
    /**
     * Remove Filter In List.
     *
     * @return static
     */
    public function removeFilterInList(): static
    {
        $this->setTypeParam('remove-filter-in-list', true);

        return $this;
    }

    /**
     * Has Remove Filter In List.
     *
     * @return bool
     */
    public function hasRemoveFilterInList(): bool
    {
        return $this->getTypeParam('remove-filter-in-list', false);
    }
}
