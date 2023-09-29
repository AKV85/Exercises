<?php

declare(strict_types=1);

namespace Exercises\FizzBuzz;

/**
 * Print numbers from 1 to n.
 * When n is divisible by 3 echo 'fizz'.
 * When n is divisible by 5 echo 'buzz.
 * When n is divisible by both 3 and 5 echo 'fizzbuzz'.
 *
 * @method static void print(int $limit)
 * @example FizzBuzz::print('5') -> 1, 2, 'fizz', 4, 'buzz'
 */
final class FizzBuzz
{
    static function print(int $limit)
    {
        for ($i = 1; $i <= $limit; $i++) {
            if ($i % 3 === 0 && $i % 5 === 0) {
                echo "fizzbuzz";
            } elseif ($i % 3 === 0) {
                echo 'fizz';
            } elseif ($i % 5 === 0) {
                echo 'buzz';
            } else {
                echo $i;
            }
        }
    }
}
