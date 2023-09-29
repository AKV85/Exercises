<?php

namespace Tests\TextOperations;

use Exercises\TextOperations\TextOperationsService;
use PHPUnit\Framework\TestCase;
use function method_exists;

class TextOperationsServiceTest extends TestCase
{

    public function testHasGet(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(TextOperationsService::class, 'capitalizeSentences'),
            'Class does not have static method get'
        );
    }

    public function testCapitalizeSentences()
    {
        $inputText = "first sentence. second sentence. third sentence";
        $expectedOutput = "First sentence. Second sentence. Third sentence";

        $outputText = TextOperationsService::capitalizeSentences($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }

    public function testRemoveExtraSpaces()
    {
        $inputText = "This   is    a    test.  It's working!  Isn't it?";
        $expectedOutput = "This is a test. It's working! Isn't it?";

        $outputText = TextOperationsService::removeExtraSpaces($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }

    public function testFormatText()
    {
        $inputText = "   this is a test.  it's working!isn't it?";
        $expectedOutput = "This is a test. It's working! Isn't it?";

        $outputText = TextOperationsService::formatText($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }
}
