<?php

namespace JobMetric\Typeify\Traits;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait HasImportType
 *
 * Adds import flag for the current type (enable / check).
 *
 * @package JobMetric\Typeify
 */
trait HasImportType
{
    /**
     * Enable import for the current type.
     *
     * @return static
     * @throws TypeifyTypeNotMatchException
     */
    public function import(): static
    {
        $this->setTypeParam('import', true);

        return $this;
    }

    /**
     * Whether import is enabled for the current type.
     *
     * @return bool
     * @throws TypeifyTypeNotMatchException
     */
    public function hasImport(): bool
    {
        return $this->getTypeParam('import', false);
    }
}
