<?php

declare(strict_types=1);

namespace Exercises\Pyramid;

/**
 * Print a pyramid.
 *
 * @method static void print(int $rows)
 * @example Pyramid::print(3)  -> '  #  '
 *                                ' ### '
 *                                '#####'
 */
final class Pyramid
{
    public static function print(int $rows)
    {
        for ($i = 0; $i < $rows; $i++) {
            $spaces = str_repeat(' ', $rows - $i - 1);
            $stars = str_repeat('#', 2 * $i + 1);
            $row = $spaces . $stars . $spaces;
            echo $row;
        }
    }
    public static function print1(int $rows): void
    {
        $columns = $rows * 2 - 1;
        $middle = floor($columns / 2);

        for ($row = 0; $row < $rows; ++$row) {
            $line = '';
            $middleLower = $middle - $row;
            $middleUpper = $middle + $row;

            for ($column = 0; $column < $columns; ++$column) {
                if ($column >= $middleLower && $middleUpper >= $column) {
                    $line .= '#';
                } else {
                    $line .= ' ';
                }
            }
            echo $line;
        }
    }

    public static function print2(int $rows, int $row = 0, string $line = ''): void
    {
        if ($rows === $row) {
            return;
        }

        $columns = $rows * 2 - 1;
        $length = strlen($line);

        if ($length === $columns) {
            echo $line;
            self::print2($rows, $row + 1);

            return;
        }

        $middle = floor($columns / 2);
        $middleLower = $middle - $row;
        $middleUpper = $middle + $row;

        if ($length >= $middleLower && $middleUpper >= $length) {
            $line .= '#';
        } else {
            $line .= ' ';
        }

        self::print2($rows, $row, $line);
    }
}

$numbers = [10];

foreach ($numbers as $n) {
    echo "Testing for $n x $n ma    trix \n";

    $startTimePyramid = microtime(true);
    Pyramid::print($n);
    $endTimePyramid = microtime(true);
    $executionTimePyramid = $endTimePyramid - $startTimePyramid; //0.000006  ($n=10)
    echo "Execution time for the print method: $executionTimePyramid seconds\n";

    $startTimePyramid = microtime(true);
    Pyramid::print1($n);
    $endTimePyramid = microtime(true);
    $executionTimePyramid = $endTimePyramid - $startTimePyramid; //0.000015  ($n=10)
    echo "Execution time for the print1 method: $executionTimePyramid seconds\n";

    $startTimePyramid = microtime(true);
    Pyramid::print2($n);
    $endTimePyramid = microtime(true);
    $executionTimePyramid = $endTimePyramid - $startTimePyramid; //0.000172  ($n=10)
    echo "Execution time for the print2 method: $executionTimePyramid seconds\n";
}

