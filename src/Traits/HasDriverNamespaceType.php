<?php

namespace JobMetric\Typeify\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;

/**
 * Trait HasDriverNamespaceType
 *
 * Adds driver-namespace config per type. Each type can have multiple driver classes (namespace => options).
 *
 * @package JobMetric\Typeify
 */
trait HasDriverNamespaceType
{
    /**
     * Cached driver namespace map: type key => [ namespace => options, ... ].
     *
     * @var array<string, array<string, array>>
     */
    protected array $driverNamespace = [];

    /**
     * Base name used to build the default driver namespace (e.g. "Media" for App\Media).
     */
    abstract protected function namespaceDriver(): string;

    /**
     * Register or merge driver namespace(s) for the current type. Adds a default entry if none yet.
     *
     * @param array<string, array> $driverNamespace Map of class namespace => options (e.g. deletable)
     *
     * @return static
     * @throws TypeifyTypeNotMatchException
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
     * Get the driver namespace map for the current type (namespace => options).
     *
     * @return Collection<string, array>
     * @throws TypeifyTypeNotMatchException
     */
    public function getDriverNamespace(): Collection
    {
        $driverNamespace = $this->getTypeParam('driver-namespace', []);

        if (!is_array($driverNamespace)) {
            return collect([]);
        }

        return collect($driverNamespace[$this->type] ?? []);
    }
}
