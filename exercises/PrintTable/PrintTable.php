<?php

declare(strict_types=1);

namespace Exercises\PrintTable;

/**
 * @method static void printTable(array $data) Print an array as a table.
 */
final class PrintTable
{
    public static function printTable(array $data): void
    {
        if (empty($data)) {
            echo "Masyvas yra tuščias.\n";
            return;
        }

        $keys = array_keys(reset($data));

        $columnWidths = [];
        foreach ($keys as $key) {
            $columnWidths[$key] = max(
                strlen($key) + 2,
                ...array_map(
                    static function ($row) use ($key) {
                        return strlen($row[$key]) + 2;
                    },
                    $data
                )
            );
        }

        echo '+';
        foreach ($keys as $key) {
            echo str_repeat('-', $columnWidths[$key]);
            echo '+';
        }
        echo PHP_EOL;

        echo '|';
        foreach ($keys as $key) {
            echo ' ' . str_pad($key, $columnWidths[$key] - 1, ' ') . '|';
        }
        echo PHP_EOL;

        echo '+';
        foreach ($keys as $key) {
            echo str_repeat('-', $columnWidths[$key]);
            echo '+';
        }
        echo PHP_EOL;

        $lastIndex = count($data) - 1;

        foreach ($data as $index => $row) {
            echo '|';
            foreach ($keys as $key) {
                echo ' ' . str_pad($row[$key], $columnWidths[$key] - 1, ' ') . '|';
            }
            echo PHP_EOL;

            // Печать линий только после последней строки
            if ($index === $lastIndex) {
                echo '+';
                foreach ($keys as $key) {
                    echo str_repeat('-', $columnWidths[$key]);
                    echo '+';
                }
                echo PHP_EOL;
            }
        }
    }
}

$data = [
    [
        'Name' => 'Trikse',
        'Color' => 'Green',
        'Element' => 'Earth',
        'Likes' => 'Flowers'
    ],
    [
        'Name' => 'Vardenis',
        'Element' => 'Air',
        'Likes' => 'Singing',
        'Color' => 'Blue'
    ],
    [
        'Element' => 'Water',
        'Likes' => 'Dancing',
        'Name' => 'Jonas',
        'Color' => 'Pink'
    ],
];

$startTimePrintTable = microtime(true);
PrintTable::printTable($data);
$endTimePrintTable = microtime(true);
$executionTimePrintTable = $endTimePrintTable - $startTimePrintTable;
echo "Execution time for the printTable method: $executionTimePrintTable seconds\n";
