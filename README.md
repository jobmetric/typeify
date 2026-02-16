[contributors-shield]: https://img.shields.io/github/contributors/jobmetric/typeify.svg?style=for-the-badge
[contributors-url]: https://github.com/jobmetric/typeify/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/jobmetric/typeify.svg?style=for-the-badge&label=Fork
[forks-url]: https://github.com/jobmetric/typeify/network/members
[stars-shield]: https://img.shields.io/github/stars/jobmetric/typeify.svg?style=for-the-badge
[stars-url]: https://github.com/jobmetric/typeify/stargazers
[license-shield]: https://img.shields.io/github/license/jobmetric/typeify.svg?style=for-the-badge
[license-url]: https://github.com/jobmetric/typeify/blob/master/LICENCE.md
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-blue.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/majidmohammadian

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

# Typeify

**Define Types. Attach Behavior. Scale Cleanly.**

Typeify simplifies how you define and manage type registries in Laravel. Stop scattering type configs and ad-hoc flags across your codebase—define named types once, attach labels, descriptions, import/export flags, and custom options through a single fluent API. This is where structured type management meets developer-friendly simplicity: one base class, composable traits, and the Laravel container as the single source of truth.

## Why Typeify?

### One Registry Per Concern

Keep your type definitions normalized and queryable. Each subclass of `BaseType` is a single registry (e.g. post types, product types, taxonomy types). Define types with unique keys, attach parameters via fluent methods, and read them anywhere in the request lifecycle. No duplicated config arrays or scattered conditionals.

### Composable Behavior with Traits

- **Labels & Descriptions** – Attach translatable label and description per type (`HasLabelType`, `HasDescriptionType`).
- **Import / Export** – Enable import or export per type with a single flag (`HasImportType`, `HasExportType`).
- **Hierarchical & List Options** – Mark types as hierarchical or control list UI (show description, remove filter, change status) via `HasHierarchicalType` and `HasListOptionType`.
- **Driver Namespaces** – Register custom driver classes per type with `HasDriverNamespaceType`.

Add only the traits you need. Your type classes stay thin and consistent.

### Laravel-Native Storage

All type data lives in the Laravel service container under the key returned by `typeName()`. The same definitions are available in controllers, APIs, admin panels, and CLI—no extra wiring, no custom globals. Use `trans()` for labels and descriptions so localization works out of the box.

## What is a Type?

A **type** in Typeify is a named key (e.g. `blog`, `product`, `page`) inside a single registry—your subclass of `BaseType`. Each type holds a set of **parameters**: label, description, and any flags or options you attach via traits.

- **Define** – Call `define('key')` to register a new type, then chain methods to set parameters.
- **Select** – Call `type('key')` to switch the current type and read or update its parameters.
- **Store** – All data is stored in the Laravel container under `typeName()`, so it is global and consistent for the request.

Consider a content system that needs post types (blog, news, page) and product types (physical, digital). With Typeify, you create a `PostType` and a `ProductType` registry, define each type with labels and descriptions, enable import/export or hierarchical where needed, and reuse the same definitions everywhere—in forms, tables, and API responses. The power lies not only in centralizing type config but in making it discoverable, translatable, and extensible through traits.

## What Awaits You?

By adopting Typeify, you will:

- **Reduce development time** – Focus on domain types instead of config plumbing and duplicated arrays
- **Write cleaner, more maintainable code** – One registry per concern, fluent API, no scattered type checks
- **Scale your type system effortlessly** – Add traits and new types without breaking existing ones
- **Stay Laravel-native** – Service container, `trans()` for labels/descriptions, and familiar patterns throughout
- **Empower consistency** – Same type definitions everywhere: APIs, admin panels, and CLI

## Quick Start

Install Typeify via Composer:

```bash
composer require jobmetric/typeify
```

## Usage (Examples)

Create a type registry by extending `BaseType` and implementing `typeName()`:

```php
namespace App\Type;

use JobMetric\Typeify\BaseType;

class PostType extends BaseType
{
    protected function typeName(): string
    {
        return 'post-type';
    }
}
```

Define types and attach parameters (labels, descriptions, flags):

```php
$postType = new PostType();

$postType->define('blog')
    ->label('Blog Post')
    ->description('Posts for the blog section')
    ->hierarchical()
    ->import()
    ->export();

$postType->define('news')
    ->label('News')
    ->description('News articles');
```

Select a type and read its data:

```php
$postType->type('blog');

$label = $postType->getLabel();
$description = $postType->getDescription();
$allParams = $postType->get();

$postType->ensureTypeExists('blog');
$availableTypes = $postType->getTypes();
```

## Documentation

Ready to centralize your type system? Our comprehensive documentation is your gateway to mastering Typeify:

**[📚 Read Full Documentation →](https://jobmetric.github.io/packages/typeify/)**

The documentation includes:

- **Getting Started** – Quick introduction and installation guide
- **BaseType** – Define, select, get/set parameters, container storage
- **Traits** – HasLabelType, HasDescriptionType, HasImportType, HasExportType, HasHierarchicalType, HasListOptionType, HasDriverNamespaceType
- **Exceptions** – TypeifyTypeNotFoundException, TypeifyTypeNotMatchException
- **Integration** – Using type registries in other packages and the Laravel ecosystem
- **Real-World Examples** – Post types, product types, and custom traits

## Contributing

Thank you for participating in `typeify`. A contribution guide can be found [here](CONTRIBUTING.md).

## License

The `typeify` is open-sourced software licensed under the MIT license. See [License File](LICENCE.md) for more information.
