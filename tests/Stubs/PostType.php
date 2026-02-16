<?php

namespace JobMetric\Typeify\Tests\Stubs;

use JobMetric\Typeify\BaseType;

class PostType extends BaseType
{
    protected function typeName(): string
    {
        return 'test-post-type';
    }
}
