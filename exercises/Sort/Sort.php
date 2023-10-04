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

    public static function quick(array &$input, ?int $left = 0, ?int $right = null): array
    {
        if ($right === null) {
            $right = count($input) - 1;
        }

        if ($right - $left < 1) {
            return [];
        }

        $pivotIndex = self::pivot($input, $left, $right);

        self::quick($input, $left, $pivotIndex - 1);
        self::quick($input, $pivotIndex + 1, $right);

        return $input;
    }

    public static function quick1(array &$input): array
    {
        $left = [];
        $right = [];
        if (count($input) < 1) {
            return [];
        }
        $pivot = $input[0];

        for ($i = 1; $i < count($input); $i++) {
            if ($input[$i] <= $pivot) {
                $left[] = $input[$i];
            } else {
                $right[] = $input[$i];
            }
        }
        $left = self::quick1($left);
        $right = self::quick1($right);

        $result = array_merge($left, [$pivot], $right);

        return $result;
    }
    public static function quick2(
        array &$input,
        ?int $left = 0,
        ?int $right = null
    ) {
        $pivot = $left;
        $right = $right ?? count($input) - 1;

        if ($right - $left < 1) {
            return;
        }

        // Avoid bad performance when sorting an already sorted array
        self::swap($input[intdiv($left + $right, 2)], $input[$right]);
        for ($i = $left; $i < $right; ++$i) {
            if ($input[$i] < $input[$right]) {
                self::swap($input[$i], $input[$pivot]);
                ++$pivot;
            }
        }

        self::swap($input[$pivot], $input[$right]);

        self::quick2($input, $left, $pivot - 1);
        self::quick2($input, $pivot + 1, $right);

        return $input;
    }

    public static function radix(array $input)
    {
        //find $length of biggest integer
        //create new array and sort $input by 10,100,1000
        $maxDigits = max($input);
        $maxDigitAsString = (string) $maxDigits;
        $pattern = '/\d/';
        preg_match_all($pattern, $maxDigitAsString, $matches);
        $lenght = count($matches[0]);

        for ($digitPlace = 0; $digitPlace < $lenght; $digitPlace++) {
            $buckets = array_fill(0, 10, []);

            foreach ($input as $number) {
                $digit = self::getDigit($number, $digitPlace);
                $buckets[$digit][] = $number;
            }
            $input = array_merge(...$buckets);
        }

        return $input;
    }

    private static function getDigit(int $number, int $place): int
    {
        return floor(abs($number) / pow(10, $place)) % 10;
    }

    public static function radix1(array $input): array
    {
        $digitsMax = self::mostDigits($input);

        foreach (range(0, $digitsMax) as $i) {
            $bucket = array_fill(0, 10, []);
            foreach ($input as $item) {
                $digit = self::getDigit1($item, $i);
                $bucket[$digit][] = $item;
            }
            $input = array_merge(...$bucket);
        }

        return $input;
    }

    /** @param int[] $input */
    private static function mostDigits(array $input): int
    {
        $maxDigits = 0;
        foreach ($input as $iValue) {
            $maxDigits = max($maxDigits, self::digitCount($iValue));
        }

        return $maxDigits;
    }

    private static function digitCount(int $value): int
    {
        if ($value === 0) {
            return 1;
        }

        return (int) floor(log10(abs($value))) + 1;
    }

    private static function getDigit1(int $value, int $position): int
    {
        return floor(abs($value) / 10 ** $position) % 10;
    }

    public static function pivot(&$input, $start = 0, $end = null): int
    {
        if ($end === null) {
            $end = count($input) - 1;
        }

        $pivot = $input[$start];
        $swapIndex = $start;

        for ($i = $start; $i <= $end; $i++) {
            if ($input[$i] < $pivot) {
                self::swap($input[++$swapIndex], $input[$i]);
            }
        }
        self::swap($input[$start], $input[$swapIndex]);

        return $swapIndex;
    }
}



$numbers8 = [1, -3, -5, 0, 76, 19, 90, 33];
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
$executionTimeSort = $endTimeSort - $startTimeSort; //0.00005  ($n=1000)
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
$executionTimeMerge  = $endTimeMerge  - $startTimeMerge; //0.004  ($n=1000)
echo "Execution time for the merge  method: $executionTimeMerge  seconds\n";

$startTimeQuick = microtime(true);
Sort::quick($numbers8);
$endTimeQuick  = microtime(true);
$executionTimeQuick  = $endTimeQuick  - $startTimeQuick; //0.0008  ($n=100)!!!
echo "Execution time for the quick  method: $executionTimeQuick  seconds\n";

$startTimeQuick1 = microtime(true);
Sort::quick1($numbers8);
$endTimeQuick1  = microtime(true);
$executionTimeQuick1  = $endTimeQuick1  - $startTimeQuick; //0.001  ($n=100)!!!
echo "Execution time for the quick1  method: $executionTimeQuick1  seconds\n";

$startTimeQuick = microtime(true);
Sort::quick2($numbers);
$endTimeQuick  = microtime(true);
$executionTimeQuick  = $endTimeQuick  - $startTimeQuick; //0.001  ($n=1000)
echo "Execution time for the quick2  method: $executionTimeQuick  seconds\n";

$startTimeRadix = microtime(true);
Sort::radix($numbers);
$endTimeRadix  = microtime(true);
$executionTimeRadix  = $endTimeRadix  - $startTimeRadix; //0.002  ($n=1000)
echo "Execution time for the radix  method: $executionTimeRadix  seconds\n";

$startTimeRadix1 = microtime(true);
Sort::radix1($numbers);
$endTimeRadix1  = microtime(true);
$executionTimeRadix1  = $endTimeRadix1  - $startTimeRadix1; //0.004  ($n=1000)
echo "Execution time for the radix1  method: $executionTimeRadix1  seconds\n";

