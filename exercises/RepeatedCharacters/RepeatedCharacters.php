<?php

declare(strict_types=1);

namespace Exercises\RepeatedCharacters;

final class RepeatedCharacters
{
    /**
     * Creates a string with a repeated character a specified number of times.
     *
     * @param $char The character to repeat.
     * @param int $count The number of times to repeat the character.
     * @return string The resulting string with repeated characters.
     */
    public static function createString($char, int $count): string
    {
        return str_repeat($char, $count);
    }

    /**
     * Removes duplicate characters in a string, keeping only one occurrence of each character.
     *
     * @param string $inputString The input string with duplicate characters.
     * @return string The string with duplicates removed.
     */
    public static function removeDuplicates(string $inputString): string
    {
        return preg_replace('/(.)\1+/', '$1', $inputString);
    }

    /**
     * Counts the occurrences of each character in the input string.
     *
     * @param string $inputString The input string.
     * @return array An associative array where keys are characters and values are their counts.
     */
    public static function countDuplicates(string $inputString): array
    {
        $charCounts = [];
        $chars = str_split($inputString);
        foreach ($chars as $char) {
            if (!isset($charCounts[$char])) {
                $charCounts[$char] = 1;
            } else {
                $charCounts[$char]++;
            }
        }
        return $charCounts;
    }

    public static function replace(string $char, int $count)
    {
        $pattern = "/$char/";
        $expectedString = preg_replace_callback($pattern, static function () {
            return '#';
        }, str_repeat($char, $count));

        return $expectedString;
    }
}