<?php

declare(strict_types=1);

namespace Tests\Fibonacci;

use Exercises\Fibonacci\Fibonacci;
use PHPUnit\Framework\TestCase;
use function method_exists;

final class FibonacciTest extends TestCase
{
    public function testHasGet(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Fibonacci::class, 'get'),
            'Class does not have static method get'
        );
    }

    public function testHasGet1(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Fibonacci::class, 'get1'),
            'Class does not have static method get'
        );
    }

    public function testHasGet2(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Fibonacci::class, 'get2'),
            'Class does not have static method get'
        );
    }

    public function testHasGet3(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Fibonacci::class, 'get3'),
            'Class does not have static method get'
        );
    }

    public function testGet0th()
    {

        // self::markTestSkipped();
        self::assertSame(0, Fibonacci::get(0));
    }

    public function testGet1th(): void
    {
        // self::markTestSkipped();
        self::assertSame(1, Fibonacci::get(1));
    }

    public function testGet2th(): void
    {
        // self::markTestSkipped();
        self::assertSame(1, Fibonacci::get(2));
    }

    public function testGet3th(): void
    {
        // self::markTestSkipped();
        self::assertSame(2, Fibonacci::get1(3));
    }

    public function testGet4th(): void
    {
        // self::markTestSkipped();
        self::assertSame(3, Fibonacci::get2(4));
    }

    public function testGet20th(): void
    {
        // self::markTestSkipped();
        self::assertSame(6765, Fibonacci::get3(20));
    }
}
