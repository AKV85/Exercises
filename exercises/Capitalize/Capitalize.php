<?php

declare(strict_types=1);

namespace Exercises\Capitalize;

/**
 * Capitalize each word.
 *
 * @method static string get(string $string)
 * @example Capitalize::get('hello there') === 'Hello There'
 * @example Capitalize::get("hey, so it's working!") === "Hey, So It's Working!"
 */
final class Capitalize
{
    static function get(string $string){
       return ucwords($string);
    }

    //find all words in string(transform to array)
    //replace first letter in each word to Upper
    //transform back to string
    public static function get1(string $string): string
{
    $words = preg_split('/\s+/', $string);

    foreach ($words as &$word) {
        $word = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
    }

    $string = implode(' ', $words);

    return $string;
}
}
