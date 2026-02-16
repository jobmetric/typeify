<?php

namespace JobMetric\Typeify\Traits;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait HasHierarchicalType
 *
 * Adds hierarchical flag for the current type (enable / check).
 *
 * @package JobMetric\Typeify
 */
trait HasHierarchicalType
{
    /**
     * Enable hierarchical structure for the current type.
     *
     * @return static
     * @throws TypeifyTypeNotMatchException
     */
    public function hierarchical(): static
    {
        $this->setTypeParam('hierarchical', true);

        return $this;
    }

    /**
     * Whether hierarchical is enabled for the current type.
     *
     * @return bool
     * @throws TypeifyTypeNotMatchException
     */
    public function hasHierarchical(): bool
    {
        return $this->getTypeParam('hierarchical', false);
    }
}
