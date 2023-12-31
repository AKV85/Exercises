<?php

declare(strict_types=1);

namespace Tests\Ladder;

use Exercises\Ladder\Ladder;
use PHPUnit\Framework\TestCase;
use function method_exists;

final class LadderTest extends TestCase
{
    public function testHasPrint(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Ladder::class, 'print'),
            'Class does not have static method print'
        );
    }

    public function testHasPrint1(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Ladder::class, 'print1'),
            'Class does not have static method print'
        );
    }

    public function testHasPrint2(): void
    {
        // self::markTestSkipped();
        self::assertTrue(
            method_exists(Ladder::class, 'print2'),
            'Class does not have static method print'
        );
    }

    public function testPrintLadder(): void
    {
        // self::markTestSkipped();
        $this->expectOutputString('#');
        Ladder::print(1);
    }

    public function testPrintLadder1(): void
    {
        // self::markTestSkipped();
        $this->expectOutputString('# ##');
        Ladder::print1(2);
    }

    public function testPrintLadder2(): void
    {
        // self::markTestSkipped();
        $this->expectOutputString('#    ##   ###  #### #####');
        Ladder::print2(5);
    }
}
