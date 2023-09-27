<?php

declare(strict_types=1);

namespace Exercises\Anagram;

/**
 * Two strings are anagrams if same characters are used in both.
 * Only case insensitive characters, not spaces or punctuation should be counted.
 *
 * 
 * @method static bool check(string $first, string $second)
 * @example Anagram::check('rail safety', 'fairy tales') === true
 * @example Anagram::check('roast beef', 'goat roast') === false
 * @example Anagram::check('Elvis, 'lives') === true
 */
final class Anagram
{
    static function check(string $first, string $second)
    {
        //delete empty spaces
        $first = strtolower(str_replace(' ', '', $first));
        $second = strtolower(preg_replace('/\s+/', '', $second));

        //create array with letters
        $first = str_split($first, 1);
        //sort array
        sort($first);
        //back to string
        $first = implode('', $first);

        $second = str_split($second, 1);
        sort($second);
        $second = implode('', $second);

        return $first === $second;
    }
}