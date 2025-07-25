<?php

namespace JobMetric\Typeify\Traits;

/**
 * Trait HasImportType
 *
 * @package JobMetric\Typeify
 */
trait HasImportType
{
    /**
     * Enable Import.
     *
     * @return static
     */
    public function import(): static
    {
        $this->setTypeParam('import', true);

        return $this;
    }

    /**
     * Has Import.
     *
     * @return bool
     */
    public function hasImport(): bool
    {
        return $this->getTypeParam('import', false);
    }
}
