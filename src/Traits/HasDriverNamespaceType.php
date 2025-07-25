<?php

namespace JobMetric\Typeify\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Trait HasDriverNamespaceType
 *
 * @package JobMetric\Typeify
 */
trait HasDriverNamespaceType
{
    /**
     * The driver namespace.
     *
     * @var array $driverNamespace
     */
    protected array $driverNamespace = [];

    /**
     * Namespace driver.
     *
     * @return string
     */
    abstract protected function namespaceDriver(): string;

    /**
     * Set Driver Namespace
     *
     * @param array $driverNamespace
     *
     * @return static
     */
    public function driverNamespace(array $driverNamespace): static
    {
        if (empty($this->driverNamespace[$this->type])) {
            $this->driverNamespace[$this->type] = [
                appNamespace() . Str::studly($this->namespaceDriver()) => [
                    'deletable' => true,
                ],
            ];
        }

        $this->driverNamespace[$this->type] = array_merge($this->driverNamespace[$this->type] ?? [], $driverNamespace);

        $this->setTypeParam('driver-namespace', $this->driverNamespace);

        return $this;
    }

    /**
     * Get driver namespace.
     *
     * @return Collection
     */
    public function getDriverNamespace(): Collection
    {
        $driverNamespace = $this->getTypeParam('driver-namespace', []);

        return collect($driverNamespace[$this->type] ?? []);
    }
}
