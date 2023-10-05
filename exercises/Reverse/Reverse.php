<?php

declare(strict_types=1);

namespace Exercises\Reverse;

use Exercises\Reverse\Reverse as ReverseReverse;

/**
 * Create methods that reverse given input by its positions.
 *
 * @method static int int(int $number)
 * @method static string string(string $string)
 * @example Reverse::int(12) === 21
 * @example Reverse::int(912) === 219
 * @example Reverse::int(120) === 21
 * @example Reverse::int(-12) === -21
 * @example Reverse::int(-120) === -21
 * @example Reverse::string('qwerty')  === 'ytrewq'
 * @example Reverse::string('apple')  === 'elppa'
 */
final class Reverse
{
    public static function string(string $string)
    {
        $array = str_split($string, 1);
        $newArray = [];
        for ($i = count($array) - 1; $i >= 0; $i--) {
            $newArray[] = $array[$i];
        }

        $string = implode('', $newArray);
        return $string;
    }

    public static function string1(string $string): string
    {
        return strrev($string);
    }

    public static function string2(string $string): string
    {
        return implode(array_reverse(str_split($string)));
    }

    public static function string3(string $string): string
    {
        $reversed = '';
        $length = strlen($string);

        for ($i = 0; $i < $length; ++$i) {
            $reversed = $string[$i] . $reversed;
        }

        return $reversed;
    }

    public static function string4(string $string): string
    {
        return array_reduce(str_split($string), static function ($carry, $char) {
            return $char . $carry;
        });
    }

    public static function string5(string $string): string
    {
        $revers = '';

        for ($i = mb_strlen($string); $i >= 0; $i--) {
            $revers .= mb_substr($string, $i, 1);
        }

        return $revers;
    }

    public static function int(int $number): int
    {
        /** @see https://wiki.php.net/rfc/combined-comparison-operator */
        $sign = $number <=> 0;

        return $sign * (int) strrev((string) $number);
    }

    public static function int2(int $number): int
    {
        $revers = 0;

        $sign = $number <=> 0;
        $number = abs($number);

        $n = (int) log10($number) + 1;

        for ($i = 1; $i <= $n; $i++) {
            $pow = pow(10, $n - $i);
            $numeral = (int) ($number / $pow);
            $number -= $numeral * $pow;
            $revers += $numeral * pow(10, $i - 1);
        }

        return $revers * $sign;
    }

    public static function int3(int $number): int
    {
        $reverse = 0;

        $sign = $number <=> 0;
        $number = abs($number);

        while ($number > 0) {
            $lastDigit = $number % 10;
            $reverse = ($reverse * 10) + $lastDigit;
            $number = (int) ($number / 10);
        }

        return $reverse * $sign;
    }

    public static function int4(int $number)
    {
        $isNegative = $number < 0;
        $number = abs($number);
        $number = (string)$number;
        $array = str_split($number, 1);
        $lastNumber = count($array) - 1;
        $newArray = [];
        for ($i = $lastNumber; $i >= 0; $i--) {
            if ($array[$lastNumber] === 0) {
                $i--;
            }
            $newArray[] = $array[$i];
        }

        $number = implode('', $newArray);
        $number=(int)$number;
        if ($isNegative) {
            $number = -$number;
        }

        return $number;
    }
}

$int = 1234567890;
$string=' hello_World ';

$startTimeReverse = microtime(true);
Reverse::int($int);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000004  ($int=1234567890)
echo "Execution time for the int method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::int2($int);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000008   ($int=1234567890)
echo "Execution time for the int2 method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::int3($int);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000002   ($int=1234567890) winner
echo "Execution time for the int3 method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::int4($int);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000005  ($int=1234567890)
echo "Execution time for the int4 method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::string($string);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000002  ($string=' hello_World ')
echo "Execution time for the string method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::string1($string);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.0000009  ($string=' hello_World ') winner
echo "Execution time for the string1 method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::string2($string);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000002  ($string=' hello_World ')
echo "Execution time for the string2 method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::string3($string);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000003  ($string=' hello_World ')
echo "Execution time for the string3 method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::string4($string);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000012  $string=' hello_World '
echo "Execution time for the string4 method: $executionTimeReverse seconds\n";

$startTimeReverse = microtime(true);
Reverse::string5($string);
$endTimeReverse = microtime(true);
$executionTimeReverse = $endTimeReverse - $startTimeReverse; //0.000006  $string=' hello_World '
echo "Execution time for the string5 method: $executionTimeReverse seconds\n";
