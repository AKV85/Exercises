<?php

declare(strict_types=1);

namespace Exercises\Sort;

/**
 * Implement sorting algorithms.
 *
 * @method static array bubble(array $input) Bubble Sort
 * @method static array selection(array $input) Selection Sort
 * @method static array insertion(array $input) Insertion Sort
 * @method static array merge(array $input) Merge Sort
 * @method static array quick(array $input) Quick Sort
 * @method static array radix(array $input) Radix Sort
 */
final class Sort
{
    public static function bubble(array $input)
    {

        for ($i = 0; $i < count($input); $i++) {
            if ($i === 0) {
                $i++;
            }
            if ($input[$i] < $input[$i - 1]) {
                $temp = $input[$i];
                $input[$i] = $input[$i - 1];
                $input[$i - 1] = $temp;
                $i -= 2;
            }
        }
        return $input;
    }

    public static function bubble1(array $input): array
    {
        $noSwap = true;
        $length = count($input) - 1;

        while ($noSwap) {
            $noSwap = false;

            for ($i = 0; $i < $length; ++$i) {
                if ($input[$i] > $input[$i + 1]) {
                    self::swap($input[$i], $input[$i + 1]);
                    $noSwap = true;
                }
            }
        }

        return $input;
    }

    public static function sortArr($input)
    {
        return sort($input);
    }

    private static function swap(&$x, &$y): void
    {
        $tmp = $x;
        $x = $y;
        $y = $tmp;
    }

    public static function selection(array $input): array
    {
        for ($i = 0; $i < count($input) - 1; $i++) {
            $indexMin = $i;
            for ($j = $i + 1; $j < count($input); $j++) {
                if ($input[$indexMin] > $input[$j]) {
                    $indexMin = $j;
                }
            }
            if ($indexMin != $i) {
                self::swap($input[$i], $input[$indexMin]);
            }
        }
        return $input;
    }

    public static function insertion(array $input)
    {
        foreach ($input as $i => $value) {
            for ($j = $i; $j > 0 && $input[$j - 1] > $value; --$j) {
                $input[$j] = $input[$j - 1];
            }
            $input[$j] = $value;
        }
        return $input;
    }

    public static function merge(array $input)
    {
        //split array to many arrays with 1 element in each(every time to the right and the left)
        //create array and start merge elements there
        if (count($input) <= 1) {
            return $input;
        }

        $mid = intdiv(count($input), 2);
        $left = [];
        for ($i = 0; $i < $mid; $i++) {
            $left[] = $input[$i];
        }
        $right = [];
        for ($i = $mid; $i < count($input); $i++) {
            $right[] = $input[$i];
        }

        $left = self::merge($left);
        $right = self::merge($right);

        return self::merger($left, $right);
    }

    private static function merger(array $left, array $right): array
    {
        $results = [];

        while (count($left) && count($right)) {
            if ($left[0] < $right[0]) {
                $results[] = array_shift($left);
            } else {
                $results[] = array_shift($right);
            }
        }

        return array_merge($results, $left, $right);
    }
}



// $numbers = [1, -3, -5, 0, 76, 19, 90, 33];
$numbers = array_reverse(range(1, 1000));

$startTimeBubble = microtime(true);
Sort::bubble($numbers);
$endTimeBubble = microtime(true);
$executionTimeBubble = $endTimeBubble - $startTimeBubble; //0.17  ($n=1000)
echo "Execution time for the bubble method: $executionTimeBubble seconds\n";

$startTimeBubble1 = microtime(true);
Sort::bubble1($numbers);
$endTimeBubble1 = microtime(true);
$executionTimeBubble1 = $endTimeBubble1 - $startTimeBubble1; //0.13  ($n=1000)
echo "Execution time for the bubble1 method: $executionTimeBubble1 seconds\n";

$startTimeSort = microtime(true);
Sort::sortArr($numbers);
$endTimeSort = microtime(true);
$executionTimeSort = $endTimeSort - $startTimeSort; //0.000056  ($n=1000)
echo "Execution time for the sortArr method: $executionTimeSort seconds\n";

$startTimeSelection = microtime(true);
Sort::selection($numbers);
$endTimeSelection = microtime(true);
$executionTimeSelection = $endTimeSelection - $startTimeSelection; //0.066  ($n=1000)
echo "Execution time for the selection method: $executionTimeSelection seconds\n";

$startTimeInsertion = microtime(true);
Sort::insertion($numbers);
$endTimeInsertion = microtime(true);
$executionTimeInsertion = $endTimeInsertion - $startTimeInsertion; //0.018  ($n=1000)
echo "Execution time for the insertion method: $executionTimeInsertion seconds\n";

$startTimeMerge = microtime(true);
Sort::merge($numbers);
$endTimeMerge  = microtime(true);
$executionTimeMerge  = $endTimeMerge  - $startTimeMerge; //0.003  ($n=1000)
echo "Execution time for the merge  method: $executionTimeMerge  seconds\n";
