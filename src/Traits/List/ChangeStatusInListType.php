<?php

namespace JobMetric\Typeify\Traits\List;

/**
 * Trait ChangeStatusInListType
 *
 * @package JobMetric\Typeify
 */
trait ChangeStatusInListType
{
    /**
     * Enable Change Status In List.
     *
     * @return static
     */
    public function changeStatusInList(): static
    {
        $this->setTypeParam('change-status-in-list', true);

        return $this;
    }

    /**
     * Has Change Status In List.
     *
     * @return bool
     */
    public function hasChangeStatusInList(): bool
    {
        return $this->getTypeParam('change-status-in-list', false);
    }
}
