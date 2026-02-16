<?php

namespace JobMetric\Typeify\Tests\Unit\Exceptions;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotFoundException;
use PHPUnit\Framework\TestCase;

class TypeifyTypeNotFoundExceptionTest extends TestCase
{
    public function test_message_contains_service_and_type(): void
    {
        $e = new TypeifyTypeNotFoundException('post-type', 'blog');

        $this->assertSame('Type [blog] is not available in service [post-type].', $e->getMessage());
        $this->assertSame(400, $e->getCode());
    }

    public function test_custom_code(): void
    {
        $e = new TypeifyTypeNotFoundException('post-type', 'blog', 404);

        $this->assertSame(404, $e->getCode());
    }
}
