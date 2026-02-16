<?php

namespace JobMetric\Typeify\Traits;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait HasExportType
 *
 * Adds export flag for the current type (enable / check).
 *
 * @package JobMetric\Typeify
 */
trait HasExportType
{
    /**
     * Enable export for the current type.
     *
     * @return static
     * @throws TypeifyTypeNotMatchException
     */
    public function export(): static
    {
        $this->setTypeParam('export', true);

        return $this;
    }

    /**
     * Whether export is enabled for the current type.
     *
     * @return bool
     * @throws TypeifyTypeNotMatchException
     */
    public function hasExport(): bool
    {
        return $this->getTypeParam('export', false);
    }
}
