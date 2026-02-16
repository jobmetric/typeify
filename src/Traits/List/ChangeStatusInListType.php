<?php

namespace JobMetric\Typeify\Traits\List;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait ChangeStatusInListType
 *
 * Adds "change status in list" flag for the current type (enable / check).
 *
 * @package JobMetric\Typeify
 */
trait ChangeStatusInListType
{
    /**
     * Enable change-status-in-list for the current type.
     *
     * @return static
     * @throws TypeifyTypeNotMatchException
     */
    public function changeStatusInList(): static
    {
        $this->setTypeParam('change-status-in-list', true);

        return $this;
    }

    /**
     * Whether change-status-in-list is enabled for the current type.
     *
     * @return bool
     * @throws TypeifyTypeNotMatchException
     */
    public function hasChangeStatusInList(): bool
    {
        return $this->getTypeParam('change-status-in-list', false);
    }
}
