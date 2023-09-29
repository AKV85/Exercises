<?php

declare(strict_types=1);

namespace Tests\RepeatedCharacters;

use Exercises\RepeatedCharacters\RepeatedCharacters;
use PHPUnit\Framework\TestCase;
use function method_exists;

final class RepeatedCharactersTest extends TestCase
{
    public function testHasCreateString(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RepeatedCharacters::class, 'createString'),
            'Class does not have static method print'
        );
    }

    public function testHasRemoveDuplicates(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RepeatedCharacters::class, 'removeDuplicates'),
            'Class does not have static method print'
        );
    }

    public function testHasCountDuplicates(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RepeatedCharacters::class, 'countDuplicates'),
            'Class does not have static method print'
        );
    }

    public function testHasReplace(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RepeatedCharacters::class, 'replace'),
            'Class does not have static method print'
        );
    }

    public function testCreateString()
    {
        $char = 'A';
        $count = 5;
        $expectedOutput = 'AAAAA';

        $outputString = RepeatedCharacters::createString($char, $count);

        $this->assertSame($expectedOutput, $outputString);
    }

    public function testRemoveDuplicates()
    {
        $inputString = 'aabbcc';
        $expectedOutput = 'abc';

        $outputString = RepeatedCharacters::removeDuplicates($inputString);

        $this->assertSame($expectedOutput, $outputString);
    }

    public function testCountDuplicates()
    {
        $inputString = 'aabbcc';
        $expectedCounts = ['a' => 2, 'b' => 2, 'c' => 2];

        $charCounts = RepeatedCharacters::countDuplicates($inputString);

        $this->assertSame($expectedCounts, $charCounts);
    }

    public function testReplace(): void
    {
        $char = '#';
        $count = 3;
        $expectedOutput = '###';

        $output = RepeatedCharacters::replace($char, $count);

        $this->assertSame($expectedOutput, $output);
    }
}
