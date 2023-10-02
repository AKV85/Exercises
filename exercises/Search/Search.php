<?php

declare(strict_types=1);

namespace Exercises\Search;

use phpDocumentor\Reflection\Types\Integer;

/**
 * Implement Linear and Binary search that returns $n if found otherwise null.
 * Implement Naive search that returns int repetitions of $n inside of a $string.
 *
 * @method static int|null linear(int[] $input, int $n)
 * @method static int|null binary(int[] $input, int $n)
 * @method static int naive(string $input, string $n)
 */
final class Search
{
    public static function linear($input, int $n)
    {
        for ($i = 0; $i < count($input); $i++) {
            if ($input[$i] === $n) {

                return $i;
            }
        }
        return null;
    }

    public static function linear1(array $input, int $n): ?int
    {
        foreach ($input as $i => $v) {
            if ($v === $n) {

                return $i;
            }
        }
        return null;
    }

    public static function binary(array $input, int $n)
    {
        $min = 0;
        $max = count($input) - 1;

        while ($min <= $max) {
            $mid = intval($min + $max, 2);

            if ($n === $input[$mid]) {
                return $mid;
            }
            if ($n > $input[$mid]) {
                $min = $mid + 1;
            } else {
                $max = $mid - 1;
            }
        }
        return null;
    }

    public static function binary1(array $input, int $n): ?int
    {
        if (count($input) === 0) {
            return null;
        }

        $start = 0;
        $end = count($input) - 1;
        $middle = ($start + $end) / 2;
        $middle = (int) $middle;

        while ($input[$middle] !== $n && $start <= $end) {
            if ($n < $input[$middle]) {
                $end = $middle - 1;
            } else {
                $start = $middle + 1;
            }
            $middle = ($start + $end) / 2;
            $middle = (int) $middle;
        }

        return $input[$middle] === $n ? $middle : null;
    }

    public static function naive(string $input, string $n): ?int
    {
        $counter = 0;

        for ($i = 0, $iMax = strlen($input) - strlen($n) + 1; $i < $iMax; ++$i) {
            $match = true;
            for ($j = 0, $nMax = strlen($n); $j < $nMax; ++$j) {
                if ($n[$j] !== $input[$i + $j]) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                ++$counter;
            }
        }

        return $counter;
    }
}

$numbers = range(1, 1000000);
$n = 1000000;

$startTimeGet = microtime(true);
Search::linear($numbers, $n);
$endTimeGet = microtime(true);
$executionTimeGet = $endTimeGet - $startTimeGet; //0.13  ($n=1000000)
echo "Execution time for the linear method: $executionTimeGet seconds\n";

$startTimeGet1 = microtime(true);
Search::linear1($numbers, $n);
$endTimeGet1 = microtime(true);
$executionTimeGet1 = $endTimeGet1 - $startTimeGet1; //0.02  ($n=1000000) linear winner
echo "Execution time for the linear1 method: $executionTimeGet1 seconds\n";

$startTimeGet2 = microtime(true);
Search::binary($numbers, $n);
$endTimeGet2 = microtime(true);
$executionTimeGet2 = $endTimeGet2 - $startTimeGet2; //0.000012  ($n=1000000)
echo "Execution time for the binary method: $executionTimeGet2 seconds\n";

$startTimeGet2 = microtime(true);
Search::binary1($numbers, $n);
$endTimeGet2 = microtime(true);
$executionTimeGet2 = $endTimeGet2 - $startTimeGet2; //0.000006  ($n=1000000) binary winner
echo "Execution time for the binary1 method: $executionTimeGet2 seconds\n";
