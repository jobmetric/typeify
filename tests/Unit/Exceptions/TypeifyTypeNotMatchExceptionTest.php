<?php

namespace JobMetric\Typeify\Tests\Unit\Exceptions;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;
use PHPUnit\Framework\TestCase;

class TypeifyTypeNotMatchExceptionTest extends TestCase
{
    public function test_message_contains_service_and_type(): void
    {
        $e = new TypeifyTypeNotMatchException('App\PostType', 'news');

        $this->assertSame('Type [news] is not match in service [App\PostType].', $e->getMessage());
        $this->assertSame(400, $e->getCode());
    }

    public function test_custom_code(): void
    {
        $e = new TypeifyTypeNotMatchException('post-type', 'blog', 422);

        $this->assertSame(422, $e->getCode());
    }
}
