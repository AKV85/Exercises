<?php

declare(strict_types=1);

namespace Exercises\ArrayGroup;

/**
 * Divide the array into many sub-arrays,
 * where each subarray is at most of group size.
 *
 * @method static any[] group(any[] $array, int $size)
 * @example ArrayGroup::group([1, 2, 3, 4, 5], 2) -> [[ 1, 2], [3, 4], [5]]
 * @example ArrayGroup::group([1, 2, 3, 4, 5], 3) -> [[ 1, 2, 3], [4, 5]]
 * @example ArrayGroup::group([1, 2, 3, 4, 5], 6) -> [[ 1, 2, 3, 4, 5]]
 */
final class ArrayGroup
{
    public static function group(array $array, int $size): array
    {
        $grouped = [];

        for ($i = 0, $iMax = count($array); $i < $iMax; $i += $size) {
            $grouped[] = array_slice($array, $i, $size);
        }

        return $grouped;
    }


    public static function group1(array $array, int $size): array
    {
        $grouped = [];
        $temporary = [];
        foreach ($array as $iValue) {
            $temporary[] = $iValue;

            if (count($temporary) === $size) {
                $grouped[] = $temporary;
                $temporary = [];
            }
        }

        if (!empty($temporary)) {
            $grouped[] = $temporary;
        }

        return $grouped;
    }

    public static function group2(array $array, int $size): array
    {
        return array_chunk($array, $size);
    }
}

$sizes = [100, 1000, 10000];

foreach ($sizes as $size) {
    echo "Testing for an array size of $size:\n";

    $array = range(1, $size);

    $startTimeGroup = microtime(true);
    $resultGroup = ArrayGroup::group($array, 10);
    $endTimeGroup = microtime(true);
    $executionTimeGroup = $endTimeGroup - $startTimeGroup;

    $startTimeGroup1 = microtime(true);
    $resultGroup1 = ArrayGroup::group1($array, 10);
    $endTimeGroup1 = microtime(true);
    $executionTimeGroup1 = $endTimeGroup1 - $startTimeGroup1;

    $startTimeGroup2 = microtime(true);
    $resultGroup2 = ArrayGroup::group2($array, 10);
    $endTimeGroup2 = microtime(true);
    $executionTimeGroup2 = $endTimeGroup2 - $startTimeGroup2;

    echo "Execution time for the group method: $executionTimeGroup seconds\n";//0.0002 for 10000
    echo "Execution time for the group1 method: $executionTimeGroup1 seconds\n";//0.0025 for 10000
    echo "Execution time for the group2 method: $executionTimeGroup2 seconds\n";//0.0001 for 10000
}
