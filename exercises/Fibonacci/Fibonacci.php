<?php

declare(strict_types=1);

namespace Exercises\Fibonacci;

/**
 * The fibonacci series is a series of numbers where
 * each consecutive number is the sum of the previous two.
 * For example [0, 1, 1, 2, 3, 5, 8, 13, 21, 34, ∞]
 *
 * @method static int get(int $index)
 * @example Fibonacci::get(7) === 13
 */
final class Fibonacci
{
      /** @var array<int> */
    private static $memo = [];

    public static function get(int $index): int
    {
        $result = [];

        for ($i = 0; $i <= $index; ++$i) {
            if ($i < 2) {
                $result[] = $i;
            } else {
                $result[] = $result[$i - 1] + $result[$i - 2];
            }
        }

        return $result[$index];
    }


    public static function get1(int $index): int
    {
        if ($index < 2) {
            return $index;
        }

        if (!isset(self::$memo[$index])) {
            self::$memo[$index] = self::get1($index - 1) + self::get1($index - 2);
        }

        return self::$memo[$index];
    }

    public static function get2(int $index): int
    {
        if ($index < 2) {
            return $index;
        }

        return self::get2($index - 1) + self::get2($index - 2);
    }

    public static function get3(int $index): int
    {
        if (array_key_exists($index, self::$memo)) {
            return self::$memo[$index];
        }

        if ($index < 2) {
            self::$memo[$index] = $index;

            return $index;
        }

        $result = self::get3($index - 1) + self::get3($index - 2);
        self::$memo[$index] = $result;

        return $result;
    }
}

$sizes = [10, 35];

foreach ($sizes as $size) {
    echo "Testing for Fibonacci number at index $size:\n";

    $startTimeGet = microtime(true);
    Fibonacci::get($size);
    $endTimeGet = microtime(true);//0.000003  (index=35)
    $executionTimeGet = $endTimeGet - $startTimeGet;
    echo "Execution time for the get method: $executionTimeGet seconds\n";

    $startTimeGet1 = microtime(true);
    Fibonacci::get1($size);
    $endTimeGet1 = microtime(true);//0.00001  (index=35)
    $executionTimeGet1 = $endTimeGet1 - $startTimeGet1;
    echo "Execution time for the get1 method: $executionTimeGet1 seconds\n";

    $startTimeGet2 = microtime(true);
    Fibonacci::get2($size);
    $endTimeGet2 = microtime(true);//4.1  (so bad, recursion without cache) (index=35)
    $executionTimeGet2 = $endTimeGet2 - $startTimeGet2;
    echo "Execution time for the get2 method: $executionTimeGet2 seconds\n";

    $startTimeGet3 = microtime(true);
    Fibonacci::get3($size);
    $endTimeGet3 = microtime(true);//0.000005  (index=35)  On index=10 this method was the best
    $executionTimeGet3 = $endTimeGet3 - $startTimeGet3;
    echo "Execution time for the get3 method: $executionTimeGet3 seconds\n";
}
