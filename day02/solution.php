<?php

    /**
     * @param  string $puzzle
     * @param  string $typ
     * @return int
     */
    function solve(string $puzzle, string $type = null) : int
    {
        $checksum = 0;
        $rows = explode(PHP_EOL, $puzzle);

        foreach ($rows as $row) {
            switch ($type) {
                case 'divisible':
                    $checksum += divisible($row);
                    break;

                default:
                    $checksum += diff($row);
                    break;
            }
        }

        return $checksum;
    }

    /**
     * Return the sum of max-min
     * @param  string $row
     * @return int
     */
    function diff(string $row) : int
    {
        $cells = preg_split('/\s+/', $row);
        $max = max($cells);
        $min = min($cells);

        return $max-$min;
    }

    /**
     * Return the "divided divisible" cells
     * @param  string $row
     * @return int
     */
    function divisible(string $row) : int
    {
        $cells = preg_split('/\s+/', $row);
        foreach ($cells as $pass1) {
            foreach ($cells as $pass2) {
                if ($pass1 % $pass2 == 0 && $pass1 != $pass2) {
                    return $pass1 / $pass2;
                }
            }
        }
    }

    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 32121
    echo sprintf("Solution Part 2: %s \n", solve($input, 'divisible')); // 197
    exit();
