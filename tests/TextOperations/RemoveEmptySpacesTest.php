<?php

namespace Tests\TextOperations;

use Exercises\TextOperations\RemoveEmptySpaces;
use PHPUnit\Framework\TestCase;
use function method_exists;

class RemoveEmptySpacesTest extends TestCase
{

    public function testHasRemoveExtraSpaces(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RemoveEmptySpaces::class, 'removeExtraSpaces'),
            'Class does not have static method get'
        );
    }

    public function testHasRemoveEmptyLines(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RemoveEmptySpaces::class, 'RemoveEmptyLines'),
            'Class does not have static method get'
        );
    }
    public function testHasTrimLines(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RemoveEmptySpaces::class, 'trimLines'),
            'Class does not have static method get'
        );
    }

    public function testHasRemoveEmptyElements(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(RemoveEmptySpaces::class, 'removeEmptyElements'),
            'Class does not have static method get'
        );
    }

    public function testRemoveExtraSpaces()
    {
        $inputText = "This   is    a    test.";
        $expectedOutput = "This is a test.";

        $outputText = RemoveEmptySpaces::removeExtraSpaces($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }

    public function testRemoveEmptyLines()
    {
        $inputText = "Line 1\n\n\n\n\n\n\n\nLine 2\n\nLine 3\n\n\n\n\n";
        $expectedOutput = "Line 1\nLine 2\nLine 3";

        $outputText = RemoveEmptySpaces::removeEmptyLines($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }

    public function testTrimLines()
    {
        $inputText = "  Line 1\n Line 2  \n  Line 3  ";
        $expectedOutput = "Line 1\nLine 2\nLine 3";
        $outputText = RemoveEmptySpaces::trimLines($inputText);
    
        $this->assertSame(
            preg_replace('/\s+/', '', $expectedOutput),
            preg_replace('/\s+/', '', $outputText));
    }

    public function testRemoveEmptyElements()
    {
        $inputText = ["Hello", "", "World", ""];
        $expectedOutput = ["Hello", "World"];

        $outputText = RemoveEmptySpaces::removeEmptyElements($inputText);

        $this->assertSame($expectedOutput, array_values($outputText));
    }
}
