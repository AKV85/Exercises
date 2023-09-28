<?php

namespace Tests\TextOperations;

use Exercises\TextOperations\NewSentenceCapitalLetters;
use PHPUnit\Framework\TestCase;
use function method_exists;

class CapitalizeSentencesTest extends TestCase
{

    public function testHasGet(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(NewSentenceCapitalLetters::class, 'capitalizeSentences'),
            'Class does not have static method get'
        );
    }

    public function testCapitalizeSentences()
    {
        $inputText = "first sentence. second sentence. third sentence";
        $expectedOutput = "First sentence. Second sentence. Third sentence";

        $outputText = NewSentenceCapitalLetters::capitalizeSentences($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }

    public function testRemoveExtraSpaces()
    {
        $inputText = "This   is    a    test.  It's working!  Isn't it?";
        $expectedOutput = "This is a test. It's working! Isn't it?";

        $outputText = NewSentenceCapitalLetters::removeExtraSpaces($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }

    public function testFormatText()
    {
        $inputText = "   this is a test.  it's working!isn't it?";
        $expectedOutput = "This is a test. It's working! Isn't it?";

        $outputText = NewSentenceCapitalLetters::formatText($inputText);

        $this->assertSame($expectedOutput, $outputText);
    }
}
