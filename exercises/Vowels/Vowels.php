<?php

declare(strict_types=1);

namespace Exercises\Vowels;

/**
 * Count string vowels (aeiou).
 *
 * @method static int count(string $string)
 * @example Vowels::count('Hello!')  === 2
 * @example Vowels::count('Why?')  === 0
 */
final class Vowels
{
    public static function count(string $string)
    {
        $pattern = '/[euioaEIUOA]/';
        return preg_match_all($pattern, $string);
    }

    public static function count1(string $string): int
    {
        return strlen(preg_replace('#[^aeiou]#i', '', $string));
    }

    public static function count2(string $string): int
    {
        $counter = 0;

        foreach (str_split(strtolower($string)) as $char) {
            if (strpos('aeiou', $char) === false) {
                continue;
            }

            ++$counter;
        }

        return $counter;
    }

    public static function count3(string $string): int
    {
        $counter = 0;
        $length = strlen($string);
        $vowels = ['a', 'e', 'i', 'o', 'u'];

        for ($i = 0; $i < $length; ++$i) {
            if (in_array(strtolower($string[$i]), $vowels, true)) {
                ++$counter;
            }
        }

        return $counter;
    }
}

$string=' hello_World and people all there ! What\'s up, Doc?This text isn\'t very huge';

$startTimeVowels = microtime(true);
Vowels::count($string);
$endTimeVowels = microtime(true);
$executionTimeVowels = $endTimeVowels - $startTimeVowels; //0.000025
echo "Execution time for the count method: $executionTimeVowels seconds\n";

$startTimeVowels = microtime(true);
Vowels::count1($string);
$endTimeVowels = microtime(true);
$executionTimeVowels = $endTimeVowels - $startTimeVowels; //0.000004  winner
echo "Execution time for the count1 method: $executionTimeVowels seconds\n";

$startTimeVowels = microtime(true);
Vowels::count2($string);
$endTimeVowels = microtime(true);
$executionTimeVowels = $endTimeVowels - $startTimeVowels; //0.000016
echo "Execution time for the count2 method: $executionTimeVowels seconds\n";

$startTimeVowels = microtime(true);
Vowels::count3($string);
$endTimeVowels = microtime(true);
$executionTimeVowels = $endTimeVowels - $startTimeVowels; //0.000028
echo "Execution time for the count3 method: $executionTimeVowels seconds\n";

