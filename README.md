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

A flexible and extensible type system for managing structured data behaviors in Laravel applications.

---

## Introduction

**Typeify** is a powerful and modular PHP package designed for Laravel that enables developers to define and manage multiple `"types"` of data entities with customized behaviors and metadata. Inspired by systems like WordPress post types and taxonomies, Typeify helps you centralize and organize your application’s data structures, making it easy to register types, attach labels, descriptions, import/export options, hierarchical relations, and more — all extensible through traits.

This package allows you to keep your data types self-describing and behavior-rich without cluttering your models or services.

---

## Features

- Define and register custom types with unique keys.
- Attach labels and descriptions with localization support.
- Enable import/export capabilities per type.
- Manage hierarchical relationships.
- Easily toggle UI/behavior options like change status in lists, remove filters, show descriptions.
- Support for driver namespaces to extend with custom classes.
- Modular traits to extend functionality without monolithic classes.
- Full integration with Laravel’s service container and macros.

---

## Installation

Run the following command to pull in the latest version:

```bash
composer require jobmetric/typeify
```

## Documentation

### Basic Usage

Create a new type service by extending the abstract `BaseType` class and defining the `typeName()` method:

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

### Defining and Registering Types

You can define new types dynamically:

```php
$postType = new PostType();

$postType->define('blog')
         ->label('Blog Post')
         ->description('Posts for the blog section')
         ->hierarchical()
         ->import()
         ->export();
```

### Selecting a Type

To work with a defined type, select it using the `type()` method:

```php
$postType->type('blog');
```

### Retrieving Type Data

Get all data or specific parameters of the current type:

```php
$allData = $postType->get();

$label = $postType->getLabel();
$description = $postType->getDescription();
```

### Traits for Extended Behavior

Typeify uses traits to add modular capabilities to types:

- **HasLabelType**: Manage type labels.
- **HasDescriptionType**: Manage type descriptions.
- **HasImportType**: Enable import support.
- **HasExportType**: Enable export support.
- **HasHierarchicalType**: Mark types as hierarchical.
- **HasListOptionType**: Enable list-related options such as:
- - Show description in list
- - Remove filters in list
- - Change status in list
- **HasDriverNamespaceType**: Manage driver namespaces to integrate external driver classes.

Example of adding traits to your custom type:

```php
use JobMetric\Typeify\Traits\HasLabelType;
use JobMetric\Typeify\Traits\HasDescriptionType;
use JobMetric\Typeify\Traits\HasImportType;
use JobMetric\Typeify\Traits\HasExportType;

class ProductType extends BaseType
{
    use HasLabelType, HasDescriptionType, HasImportType, HasExportType;

    protected function typeName(): string
    {
        return 'productType';
    }
}
```

## Integration with Laravel

Typeify leverages Laravel’s service container to store and retrieve all type information globally. This ensures your types and their parameters are easily accessible throughout your application lifecycle.

## Error Handling

- Throws `TypeifyTypeNotFoundException` when trying to select a type that hasn't been defined.
- Throws `TypeifyTypeNotMatchException` when validating if a type exists.

Make sure to catch or handle these exceptions accordingly.

## Why Use Typeify?

- **Centralized type management**: Keep all your data types' configurations and behaviors in one place.
- **Highly extensible**: Use traits or create new ones to extend functionality.
- **Lightweight and clean**: No bloated frameworks or rigid structures.
- **Laravel-native**: Fully leverages Laravel’s ecosystem and best practices.

## Contributing

Thank you for considering contributing to the Typeify! The contribution guide can be found in the [CONTRIBUTING.md](https://github.com/jobmetric/typeify/blob/master/CONTRIBUTING.md).

## License

The MIT License (MIT). Please see [License File](https://github.com/jobmetric/typeify/blob/master/LICENCE.md) for more information.
