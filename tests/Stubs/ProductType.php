<?php

namespace JobMetric\Typeify\Tests\Stubs;

use JobMetric\Typeify\BaseType;
use JobMetric\Typeify\Traits\HasExportType;
use JobMetric\Typeify\Traits\HasHierarchicalType;
use JobMetric\Typeify\Traits\HasImportType;

class ProductType extends BaseType
{
    use HasExportType;
    use HasHierarchicalType;
    use HasImportType;

    protected function typeName(): string
    {
        return 'test-product-type';
    }
}
