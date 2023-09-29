<?php

declare(strict_types=1);

namespace Exercises\Ladder;

/**
 * Print a ladder.
 *
 * @method static void print(int $level)
 * @example Ladder::print(3)  -> '#  '
 *                               '## '
 *                               '###'
 */
final class Ladder
{
    static function print(int $level)
    {
        $simbol = '#';
        for ($i = 1; $i <= $level; $i++) {
            $string = str_repeat($simbol, $i);
            $spaces = str_repeat(' ', $level - $i);
            echo $string . $spaces;
        }
    }

    public static function print1(int $level): void
    {
        for ($row = 0; $row < $level; ++$row) {
            $string = '';
            for ($column = 0; $column < $level; ++$column) {
                $string .= $column <= $row ? '#' : ' ';
            }
            echo $string;
        }
    }

    public static function print2(int $level, int $row = 0, $string = '')
    {
        if ($row === $level) {

            return;
        }
        $lenght = strlen($string);
        if ($lenght === $level) {
            echo $string;
            self::print2($level, $row + 1);

            return;
        }
        if ($lenght <= $row) {
            $string .= '#';
        } else {
            $string .= ' ';
        }
        self::print2($level, $row, $string);
    }
}
