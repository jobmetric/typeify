<?php

namespace JobMetric\Typeify;

use JobMetric\PackageCore\TraitBooter;
use JobMetric\Typeify\Exceptions\TypeifyTypeNotFoundException;
use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;
use JobMetric\Typeify\Traits\HasDescriptionType;
use JobMetric\Typeify\Traits\HasLabelType;
use Throwable;

/**
 * Class BaseType
 *
 * This class serves as a base for defining types in the system.
 * It provides methods to define, retrieve, and manage types and their parameters.
 *
 * @package JobMetric\Typeify
 */
abstract class BaseType
{
    use TraitBooter,
        HasLabelType,
        HasDescriptionType;

    /**
     * The type of the service.
     *
     * @var string|null $type
     */
    protected ?string $type = null;

    abstract protected function typeName(): string;

    /**
     * Set data in service container.
     *
     * @param array $params
     *
     * @return void
     */
    protected function setInContainer(array $params = []): void
    {
        if (!app()->bound($this->typeName())) {
            app()->singleton($this->typeName(), function () use ($params) {
                return $params;
            });

            return;
        }

        app()->singleton($this->typeName(), function () use ($params) {
            return $params;
        });
    }

    /**
     * Get data from service container.
     *
     * @return array
     */
    protected function getInContainer(): array
    {
        if (!app()->bound($this->typeName())) {
            app()->singleton($this->typeName(), function () {
                return [];
            });
        }

        return app($this->typeName());
    }

    /**
     * Define a new type in the system.
     *
     * @param string $type
     *
     * @return static
     */
    public function define(string $type): static
    {
        $this->type = $type;

        $types = $this->getInContainer();
        $types[$type] = [];
        $this->setInContainer($types);

        $this->boot();

        return $this;
    }

    /**
     * Set the type parameter.
     *
     * @param string $type
     *
     * @return static
     * @throws Throwable
     */
    public function type(string $type): static
    {
        $types = $this->getInContainer();

        if (isset($types[$type])) {
            $this->type = $type;

            return $this;
        }

        throw new TypeifyTypeNotFoundException($this->typeName(), $type);
    }

    /**
     * Set a type parameter in the current type.
     *
     * @param string $key
     * @param mixed $params
     *
     * @return void
     */
    protected function setTypeParam(string $key, mixed $params): void
    {
        $types = $this->getInContainer();

        $types[$this->type][$key] = $params;

        $this->setInContainer($types);
    }

    /**
     * Get the current type parameters.
     *
     * @return array
     */
    public function get(): array
    {
        $types = $this->getInContainer();

        return $types[$this->type];
    }

    /**
     * Get a specific type parameter from the current type.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    protected function getTypeParam(string $key, mixed $default = null): mixed
    {
        $types = $this->get();

        if (isset($types[$key])) {
            return $types[$key];
        }

        return $default;
    }

    /**
     * Get all types defined in the system.
     *
     * @return array
     */
    public function getTypes(): array
    {
        return array_keys($this->getInContainer());
    }

    /**
     * Check if a specific type exists in the system.
     *
     * @param string $type
     *
     * @return bool
     */
    public function hasType(string $type): bool
    {
        return in_array($type, $this->getTypes());
    }

    /**
     * Ensure that a specific type exists in the system.
     *
     * @param string $type
     *
     * @return void
     * @throws Throwable
     */
    public function ensureTypeExists(string $type): void
    {
        if (!$this->hasType($type)) {
            throw new TypeifyTypeNotMatchException(static::class, $type);
        }
    }
}
