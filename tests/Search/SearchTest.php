<?php

declare(strict_types=1);

namespace Tests\Search;

use Exercises\Search\Search;
use Exercises\Search\Complete\SearchComplete;
use PHPUnit\Framework\TestCase;
use function method_exists;

final class SearchTest extends TestCase
{
    public function testHasMethods(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Search::class, 'linear'),
            'Class does not have static method linear'
        );
        self::assertTrue(
            method_exists(Search::class, 'binary'),
            'Class does not have static method binary'
        );
        self::assertTrue(
            method_exists(Search::class, 'linear1'),
            'Class does not have static method linear'
        );
        self::assertTrue(
            method_exists(Search::class, 'binary1'),
            'Class does not have static method binary'
        );
    }

    public function testLinear(): void
    {
        // self::markTestSkipped();
        self::assertSame(5, Search::linear1([34, 51, 1, 2, 3, 45, 56, 687], 45));
        self::assertNull(Search::linear([34, 51, 1, 2, 3, 45, 56, 687], 100));
        self::assertNull(Search::linear([], 100));
    }

    public function testBinary(): void
    {
        // self::markTestSkipped();
        self::assertSame(5, Search::binary([34, 51, 1, 2, 3, 45, 56, 687], 45));
        self::assertNull(Search::binary([34, 51, 1, 2, 3, 45, 56, 687], 100));
        self::assertNull(SearchComplete::binary([], 100));
    }

    public function testBinary1(): void
    {
        // self::markTestSkipped();
        self::assertSame(5, Search::binary1([34, 51, 1, 2, 3, 45, 56, 687], 45));
        self::assertNull(Search::binary1([34, 51, 1, 2, 3, 45, 56, 687], 100));
    }

    public function testNaive(): void
    {
        // self::markTestSkipped();
        self::assertSame(4, Search::naive('oxo moxo poxoxo', 'oxo'));
        self::assertSame(0, Search::naive('ox mox pox', 'box'));
    }
}
