<?php

declare(strict_types=1);

namespace Exercises\TextOperations;

final class RemoveEmptySpaces
{
    /**
     * Removes excess spaces from a string.
     *
     * @param string $inputText The input string
     *
     * @return string The string with excess spaces removed
     *
     * @example RemoveEmptySpace::removeExtraSpaces("This   is    a    test.") -> "This is a test."
     */
    public static function removeExtraSpaces(string $inputText): string
    {
        return preg_replace('/\s+/', ' ', $inputText);
    }

    /**
     * Removes empty lines from text.
     *
     * @param string $inputText The input text
     *
     * @return string Text without empty lines
     *
     * @example RemoveEmptySpace::removeEmptyLines("Line 1\n\nLine 2\n\nLine 3") -> "Line 1\nLine 2\nLine 3"
     */
    public static function removeEmptyLines(string $inputText): string
    {
        $lines = explode("\n", $inputText);
        $nonEmptyLines = array_filter($lines, 'trim'); // Remove empty lines using trim
        return implode("\n", $nonEmptyLines);
    }

    /**
     * Trims spaces before and after each line in text.
     *
     * @param string $inputText The input text
     *
     * @return string Text with spaces removed before and after lines
     *
     * @example RemoveEmptySpace::trimLines("  Line 1\n Line 2  \n  Line 3  ") -> "Line 1\nLine 2\nLine 3"
     */
    public static function trimLines(string $inputText): string
    {
        $inputText = str_replace(["\r\n", "\r"], "\n", $inputText);

        $lines = explode("\n", $inputText);
        $trimmedLines = array_map('trim', $lines);
        return implode("\n", $trimmedLines);
    }

    /**
     * Removes empty elements from an array of strings.
     *
     * @param array $lines Array of strings
     *
     * @return array Array of strings without empty elements
     *
     * @example RemoveEmptySpace::removeEmptyElements(["Hello", "", "World", ""]) -> ["Hello", "World"]
     */
    public static function removeEmptyElements(array $elements): array
    {
        return array_filter($elements, static function ($element) {
            return !empty($element);
        });    }
}
