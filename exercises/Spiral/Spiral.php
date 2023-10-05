<?php

declare(strict_types=1);

namespace Exercises\Spiral;

/**
 * Create a spiral matrix of length * length.
 *
 * @method static array make(int $length)
 * @example Spiral::make(3) === [
 *     [1, 2, 3],
 *     [8, 9, 4],
 *     [7, 6, 5]]
 */
final class Spiral
{
    //directions:right,down,left,up
    public static function make(int $length)
    {
        $rowStart = 0;
        $rowEnd = $length - 1;
        $columnStart = 0;
        $columnEnd = $length - 1;
        $counter = 1;
        $results = [];
        while ($rowStart <= $rowEnd && $columnStart <= $columnEnd) {
            for ($column = $columnStart; $column <= $columnEnd; $column++) {
                $results[$rowStart][$column] = $counter;
                $counter++;
            }
            $rowStart++;

            for ($row = $rowStart; $row <= $rowEnd; $row++) {
                $results[$row][$columnEnd] = $counter;
                $counter++;
            }
            $columnEnd--;

            for ($column = $columnEnd; $column >= $columnStart; $column--) {
                $results[$rowEnd][$column] = $counter;
                $counter++;
            }
            $rowEnd--;

            for ($row = $rowEnd; $row >= $rowStart; $row--) {
                $results[$row][$columnStart] = $counter;
                $counter++;
            }
            $columnStart++;
        }
        return $results;
    }

    public static function make1(int $n): array
    {
        $matrix = array_fill(0, $n, array_fill(0, $n, 0));
        $left = 0;
        $right = $n - 1;
        $top = 0;
        $bottom = $n - 1;
        $x = 0;
        $y = 0;
        $direction = 'right';
        $counter = 1;

        while ($left <= $right && $top <= $bottom) {
            $matrix[$y][$x] = $counter;
            ++$counter;

            switch ($direction) {
                case 'right':
                    if ($x < $right) {
                        ++$x;
                    } else {
                        ++$top;
                        $y = $top;
                        $direction = 'down';
                    }
                    break;
                case 'down':
                    if ($y < $bottom) {
                        ++$y;
                    } else {
                        --$right;
                        $x = $right;
                        $direction = 'left';
                    }
                    break;
                case 'left':
                    if ($x > $left) {
                        --$x;
                    } else {
                        --$bottom;
                        $y = $bottom;
                        $direction = 'up';
                    }
                    break;
                case 'up':
                    if ($y > $top) {
                        --$y;
                    } else {
                        ++$left;
                        $x = $left;
                        $direction = 'right';
                    }
                    break;
            }
        }
        return $matrix;
    }

    public static function make2(int $n): array
    {
        $matrix = array_fill(0, $n, array_fill(0, $n, 0));
        $directions = [[0, 1], [1, 0], [0, -1], [-1, 0]];
        $currentDirection = 0;
        $row = 0;
        $col = 0;

        for ($i = 1; $i <= $n * $n; ++$i) {
            $matrix[$row][$col] = $i;

            $nextRow = $row + $directions[$currentDirection][0];
            $nextCol = $col + $directions[$currentDirection][1];

            if (
                $nextRow < 0 || $nextRow >= $n ||
                $nextCol < 0 || $nextCol >= $n ||
                $matrix[$nextRow][$nextCol] != 0
            ) {
                $currentDirection = ($currentDirection + 1) % 4;
            }

            $row += $directions[$currentDirection][0];
            $col += $directions[$currentDirection][1];
        }

        return $matrix;
    }
}

$numbers = [100, 1000];

foreach ($numbers as $n) {
    echo "Testing for $n x $n matrix \n";

    $startTimeSpiral = microtime(true);
    Spiral::make($n);
    $endTimeSpiral = microtime(true);
    $executionTimeSpiral = $endTimeSpiral - $startTimeSpiral; //0.07  ($n=1000)
    echo "Execution time for the make method: $executionTimeSpiral seconds\n";

    $startTimeSpiral = microtime(true);
    Spiral::make1($n);
    $endTimeSpiral = microtime(true);
    $executionTimeSpiral = $endTimeSpiral - $startTimeSpiral; //0.1  ($n=1000)
    echo "Execution time for the make1 method: $executionTimeSpiral seconds\n";

    $startTimeSpiral = microtime(true);
    Spiral::make2($n);
    $endTimeSpiral = microtime(true);
    $executionTimeSpiral = $endTimeSpiral - $startTimeSpiral; //0.2  ($n=1000)
    echo "Execution time for the make2 method: $executionTimeSpiral seconds\n";
}
