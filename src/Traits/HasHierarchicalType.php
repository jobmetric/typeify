<?php

namespace JobMetric\Typeify\Traits;

/**
 * Trait HasHierarchicalType
 *
 * @package JobMetric\Typeify
 */
trait HasHierarchicalType
{
    /**
     * Enable Hierarchical.
     *
     * @return static
     */
    public function hierarchical(): static
    {
        $this->setTypeParam('hierarchical', true);

        return $this;
    }

    /**
     * Has Hierarchical.
     *
     * @return bool
     */
    public function hasHierarchical(): bool
    {
        return $this->getTypeParam('hierarchical', false);
    }
}
