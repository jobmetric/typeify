<?php

namespace JobMetric\Typeify;

use JobMetric\PackageCore\TraitBooter;
use JobMetric\Typeify\Exceptions\TypeifyTypeNotFoundException;
use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;
use JobMetric\Typeify\Traits\HasDescriptionType;
use JobMetric\Typeify\Traits\HasLabelType;

/**
 * Class BaseType
 *
 * Base class for type registries. Subclasses register named "types" (keys) and attach
 * parameters (label, description, etc.) to each. State is stored in the Laravel
 * container under a key returned by typeName().
 *
 * @package JobMetric\Typeify
 */
abstract class BaseType
{
    use TraitBooter,
        HasLabelType,
        HasDescriptionType;

    /**
     * Currently selected type key. Must be set via define() or type() before get/set param.
     *
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Container key used to store this service's type map. Must be unique per subclass.
     *
     * @return string
     */
    abstract protected function typeName(): string;

    /**
     * Store the full type map in the Laravel container (singleton). Overwrites existing.
     *
     * @param array $params Map of type key => array of params
     */
    protected function setInContainer(array $params = []): void
    {
        app()->singleton($this->typeName(), fn () => $params);
    }

    /**
     * Read the full type map from the container. Binds to [] if not yet registered.
     *
     * @return array<string, array> Map of type key => params
     */
    protected function getInContainer(): array
    {
        if (! app()->bound($this->typeName())) {
            app()->singleton($this->typeName(), fn () => []);
        }

        return app($this->typeName());
    }

    /**
     * Register a new type with empty params and set it as current. Runs boot() after.
     *
     * @param string $type New type key
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
     * Switch current type to an existing one. Throws if the type is not registered.
     *
     * @param string $type Existing type key
     *
     * @return static
     * @throws TypeifyTypeNotFoundException When type is not defined
     */
    public function type(string $type): static
    {
        $types = $this->getInContainer();

        if (! isset($types[$type])) {
            throw new TypeifyTypeNotFoundException($this->typeName(), $type);
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Set one parameter for the current type. Throws if no type is selected.
     *
     * @param string $key   Parameter name (e.g. label, description)
     * @param mixed $params Value to store
     *
     * @throws TypeifyTypeNotMatchException When type is not set
     */
    protected function setTypeParam(string $key, mixed $params): void
    {
        if ($this->type === null) {
            throw new TypeifyTypeNotMatchException(static::class, '');
        }

        $types = $this->getInContainer();
        $types[$this->type][$key] = $params;
        $this->setInContainer($types);
    }

    /**
     * Get all parameters for the current type. Throws if no type selected or type missing.
     *
     * @return array Parameters for the current type
     * @throws TypeifyTypeNotMatchException When type is not set or not registered
     */
    public function get(): array
    {
        if ($this->type === null) {
            throw new TypeifyTypeNotMatchException(static::class, '');
        }

        $this->ensureTypeExists($this->type);

        $types = $this->getInContainer();

        return $types[$this->type];
    }

    /**
     * Get a single parameter for the current type, or default if missing.
     *
     * @param string $key    Parameter name
     * @param mixed $default Value when key is not set
     *
     * @return mixed
     * @throws TypeifyTypeNotMatchException
     */
    protected function getTypeParam(string $key, mixed $default = null): mixed
    {
        $types = $this->get();

        return $types[$key] ?? $default;
    }

    /**
     * List all registered type keys for this service.
     *
     * @return array<int, string>
     */
    public function getTypes(): array
    {
        return array_keys($this->getInContainer());
    }

    /**
     * Whether a type key is registered.
     *
     * @param string $type Type key to check
     *
     * @return bool
     */
    public function hasType(string $type): bool
    {
        return isset($this->getInContainer()[$type]);
    }

    /**
     * Throw if the type is not registered. Use before using a type from external input.
     *
     * @param string $type Type key to validate
     *
     * @throws TypeifyTypeNotMatchException When type is not registered
     */
    public function ensureTypeExists(string $type): void
    {
        if (! $this->hasType($type)) {
            throw new TypeifyTypeNotMatchException(static::class, $type);
        }
    }
}
