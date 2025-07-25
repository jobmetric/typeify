<?php

namespace JobMetric\Typeify\Traits;

/**
 * Trait HasExportType
 *
 * @package JobMetric\Typeify
 */
trait HasExportType
{
    /**
     * Enable Export.
     *
     * @return static
     */
    public function export(): static
    {
        $this->setTypeParam('export', true);

        return $this;
    }

    /**
     * Has Export.
     *
     * @return bool
     */
    public function hasExport(): bool
    {
        return $this->getTypeParam('export', false);
    }
}
