<?php

declare(strict_types=1);

namespace Exercises\Palindrome;

/**
 * Palindrome is a string that equals itself when reversed.
 * Non-alpha chars must also be included.
 *
 * @method static bool check(string $string)
 * @example Palindrome::check('asddsa')  === true
 * @example Palindrome::check('asdd')  === false
 */
final class Palindrome
{
    public static function check(string $string)
    {
        $array = str_split($string, 1);
        $last = count($array) - 1;
        $start = 0;
        while ($start < $last) {
            if ($array[$start] !== $array[$last]) {
                return false;
            }
            $start++;
            $last--;
        }

        if ($start >= $last) {
            return true;
        }
    }

    public static function check0(string $string): bool
    {
        return $string === implode(array_reverse(str_split($string)));
    }

    public static function check1(string $string): bool
    {
        $length = strlen($string);
        $half = $length / 2;

        for ($i = 0; $i < $half; ++$i) {
            if ($string[$i] !== $string[$length - $i - 1]) {
                return false;
            }
        }

        return true;
    }

    public static function check2(string $string): bool
    {
        $length = strlen($string);
        $isPalindrome = [];
        $chars = str_split($string);

        array_walk($chars, static function (
            $char,
            $key
        ) use (&$isPalindrome, $string, $length): void {
            if ($char !== $string[$length - $key - 1]) {
                $isPalindrome[] = false;
            }

            $isPalindrome[] = true;
        });

        return !in_array(false, $isPalindrome, true);
    }

    public static function check3(string $string): bool
    {
        $reversed = '';
        $length = strlen($string);
        for ($i = 0; $i < $length; ++$i) {
            $reversed = $string[$i] . $reversed;
        }
        if ($string === $reversed) {
            return true;
        }

        return false;
    }
}

$string=' ?SaY_heLlo_olLeh_YaS? ';

$startTimePalindrome = microtime(true);
Palindrome::check($string);
$endTimePalindrome = microtime(true);
$executionTimePalindrome = $endTimePalindrome - $startTimePalindrome; //0.000005
echo "Execution time for the check method: $executionTimePalindrome seconds\n";

$startTimePalindrome = microtime(true);
Palindrome::check0($string);
$endTimePalindrome = microtime(true);
$executionTimePalindrome = $endTimePalindrome - $startTimePalindrome; //0.000002
echo "Execution time for the check0 method: $executionTimePalindrome seconds\n";

$startTimePalindrome = microtime(true);
Palindrome::check1($string);
$endTimePalindrome = microtime(true);
$executionTimePalindrome = $endTimePalindrome - $startTimePalindrome; //0.000002
echo "Execution time for the check1 method: $executionTimePalindrome seconds\n";

$startTimePalindrome = microtime(true);
Palindrome::check2($string);
$endTimePalindrome = microtime(true);
$executionTimePalindrome = $endTimePalindrome - $startTimePalindrome; //0.00001  looser
echo "Execution time for the check2 method: $executionTimePalindrome seconds\n";

$startTimePalindrome = microtime(true);
Palindrome::check3($string);
$endTimePalindrome = microtime(true);
$executionTimePalindrome = $endTimePalindrome - $startTimePalindrome; //0.000002
echo "Execution time for the check3 method: $executionTimePalindrome seconds\n";