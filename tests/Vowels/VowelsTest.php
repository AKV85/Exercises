<?php

declare(strict_types=1);

namespace Tests\Vowels;

use Exercises\Vowels\Vowels;
use PHPUnit\Framework\TestCase;
use function method_exists;

final class VowelsTest extends TestCase
{
    public function testHasCount(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Vowels::class, 'count'),
            'Class does not have static method count'
        );
        self::assertTrue(
            method_exists(Vowels::class, 'count1'),
            'Class does not have static method count1'
        );
        self::assertTrue(
            method_exists(Vowels::class, 'count2'),
            'Class does not have static method count2'
        );
        self::assertTrue(
            method_exists(Vowels::class, 'count3'),
            'Class does not have static method count3'
        );
    }

    public function testCanCount(): void
    {
        // self::markTestSkipped();
        self::assertSame(6, Vowels::count('abcdefghijklmnopqrstuvwxyz  a'));
    }

    public function testCanCountAllUpper(): void
    {
        // self::markTestSkipped();
        self::assertSame(5, Vowels::count1(' !AEIOU'));
    }

    public function testCanCountOnly(): void
    {
        // self::markTestSkipped();
        self::assertSame(5, Vowels::count2('aeiou !'));
    }

    public function testCanCountNone(): void
    {
        // self::markTestSkipped();
        self::assertSame(0, Vowels::count3('bcdfghjkl !'));
    }
}
