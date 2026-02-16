<?php

namespace JobMetric\Typeify\Tests\Feature;

use JobMetric\Typeify\Exceptions\TypeifyTypeNotFoundException;
use JobMetric\Typeify\Exceptions\TypeifyTypeNotMatchException;
use JobMetric\Typeify\Tests\Stubs\PostType;
use JobMetric\Typeify\Tests\Stubs\ProductType;
use JobMetric\Typeify\Tests\TestCase as BaseTestCase;

class BaseTypeTest extends BaseTestCase
{
    /**
     * @throws TypeifyTypeNotMatchException
     */
    public function test_define_registers_type_and_sets_current(): void
    {
        $postType = new PostType();

        $postType->define('blog');

        $this->assertTrue($postType->hasType('blog'));
        $this->assertSame(['blog'], $postType->getTypes());
        $this->assertSame([], $postType->get());
    }

    public function test_define_multiple_types_accumulates_in_container(): void
    {
        $postType = new PostType();

        $postType->define('blog');
        $postType->define('news');
        $postType->define('page');

        $types = $postType->getTypes();
        sort($types);
        $this->assertSame(['blog', 'news', 'page'], $types);
    }

    /**
     * @throws TypeifyTypeNotFoundException
     * @throws TypeifyTypeNotMatchException
     */
    public function test_type_switches_current_and_throws_when_not_found(): void
    {
        $postType = new PostType();
        $postType->define('blog')->define('news');

        $postType->type('news');
        $this->assertSame([], $postType->get());

        $postType->type('blog');
        $this->assertSame([], $postType->get());

        $this->expectException(TypeifyTypeNotFoundException::class);
        $postType->type('missing');
    }

    public function test_type_not_found_exception_message(): void
    {
        $postType = new PostType();
        $postType->define('blog');

        $this->expectException(TypeifyTypeNotFoundException::class);
        $this->expectExceptionMessage('Type [missing] is not available in service [test-post-type].');

        $postType->type('missing');
    }

    public function test_get_throws_when_no_type_selected(): void
    {
        $postType = new PostType();

        $this->expectException(TypeifyTypeNotMatchException::class);

        $postType->get();
    }

    public function test_ensure_type_exists_throws_when_type_not_registered(): void
    {
        $postType = new PostType();
        $postType->define('blog');

        $this->expectException(TypeifyTypeNotMatchException::class);
        $this->expectExceptionMessage('Type [other] is not match in service');

        $postType->ensureTypeExists('other');
    }

    /**
     * @throws TypeifyTypeNotMatchException
     */
    public function test_ensure_type_exists_does_not_throw_when_type_exists(): void
    {
        $postType = new PostType();
        $postType->define('blog');

        $postType->ensureTypeExists('blog');
        $this->addToAssertionCount(1);
    }

    /**
     * @throws TypeifyTypeNotMatchException
     */
    public function test_label_and_description_fluent_and_stored(): void
    {
        $postType = new PostType();

        $postType->define('blog')->label('Blog Post')->description('Posts for the blog section');

        $this->assertSame('Blog Post', $postType->getLabel());
        $this->assertSame('Posts for the blog section', $postType->getDescription());

        $params = $postType->get();
        $this->assertSame('Blog Post', $params['label'] ?? null);
        $this->assertSame('Posts for the blog section', $params['description'] ?? null);
    }

    public function test_get_label_throws_when_no_type_selected(): void
    {
        $postType = new PostType();

        $this->expectException(TypeifyTypeNotMatchException::class);

        $postType->getLabel();
    }

    /**
     * @throws TypeifyTypeNotMatchException
     */
    public function test_export_import_hierarchical_traits_on_product_type(): void
    {
        $productType = new ProductType();

        $productType->define('physical')->label('Physical Product')->export()->import()->hierarchical();

        $this->assertTrue($productType->hasExport());
        $this->assertTrue($productType->hasImport());
        $this->assertTrue($productType->hasHierarchical());

        $productType->define('digital')->label('Digital Product');

        $this->assertFalse($productType->hasExport());
        $this->assertFalse($productType->hasImport());
        $this->assertFalse($productType->hasHierarchical());
    }

    /**
     * @throws TypeifyTypeNotFoundException
     * @throws TypeifyTypeNotMatchException
     */
    public function test_container_persists_across_same_instance(): void
    {
        $postType = new PostType();
        $postType->define('blog')->label('Blog');

        $postType->type('blog');
        $this->assertSame('Blog', $postType->getLabel());

        $postType->type('blog');
        $this->assertSame('Blog', $postType->getLabel());
    }

    /**
     * @throws TypeifyTypeNotFoundException
     * @throws TypeifyTypeNotMatchException
     */
    public function test_different_type_instances_use_same_container_key_share_data(): void
    {
        $a = new PostType();
        $a->define('blog')->label('Blog A');

        $b = new PostType();
        $b->type('blog');

        $this->assertSame('Blog A', $b->getLabel());
    }

    public function test_get_types_returns_all_registered_keys(): void
    {
        $postType = new PostType();
        $postType->define('a')->define('b')->define('c');

        $types = $postType->getTypes();
        sort($types);
        $this->assertSame(['a', 'b', 'c'], $types);
    }

    public function test_has_type_returns_false_for_unregistered(): void
    {
        $postType = new PostType();
        $postType->define('blog');

        $this->assertTrue($postType->hasType('blog'));
        $this->assertFalse($postType->hasType('news'));
    }
}
