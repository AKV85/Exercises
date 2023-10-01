<?php

declare(strict_types=1);

namespace Exercises\Numbers;

/**
 * @method static int add(int $n) add numbers from 1 up to $n including.
 * @example Numbers::add(3) === 6
 */
final class Numbers
{
    // create array
    // save all numbers in array and sum all off them
    public static function add(int $n): int
    {
        $array = [];
        for ($i = 0; $i <= $n; $i++) {
            $array[] = $i;
        }
        return array_sum($array);
    }

    public static function add1(int $n): int
    {
        return $n * ($n - 1);
    }

    public static function add2(int $n): int
    {
        $sum = 0;
        for ($i = 0; $i <= $n; $i++) {
            $sum += $i;
        }
        return $sum;
    }

    public static function addWithRegex(int $n): int
    {
        $numbersString = implode('', range(1, $n));
        preg_match_all('/\d/', $numbersString, $matches);
        $numbers = array_map('intval', $matches[0]);
        return array_sum($numbers);
    }
}

$numbers = [10, 1000000];

foreach ($numbers as $n) {
    echo "Testing for Numbers sum at argument $n:\n";

    $startTimeGet = microtime(true);
    Numbers::add($n);
    $endTimeGet = microtime(true);
    $executionTimeGet = $endTimeGet - $startTimeGet; //0.088  ($n=1000000)
    echo "Execution time for the add method: $executionTimeGet seconds\n";

    $startTimeGet1 = microtime(true);
    Numbers::add1($n);
    $endTimeGet1 = microtime(true);
    $executionTimeGet1 = $endTimeGet1 - $startTimeGet1; //0.000002  ($n=1000000) - winner
    echo "Execution time for the add1 method: $executionTimeGet1 seconds\n";

    $startTimeGet2 = microtime(true);
    Numbers::add2($n);
    $endTimeGet2 = microtime(true);
    $executionTimeGet2 = $endTimeGet2 - $startTimeGet2; //0.026  ($n=1000000)
    echo "Execution time for the add2 method: $executionTimeGet2 seconds\n";

    $startTimeGet2 = microtime(true);
    Numbers::addWithRegex($n);
    $endTimeGet2 = microtime(true);
    $executionTimeGet2 = $endTimeGet2 - $startTimeGet2; //1.257  ($n=1000000) - so bad :)
    echo "Execution time for the addWithRegex method: $executionTimeGet2 seconds\n";
}
