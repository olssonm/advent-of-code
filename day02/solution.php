<?php

    function solve($puzzle, $type = 'diff')
    {
        $checksum = 0;
        $rows = explode(PHP_EOL, $puzzle);

        foreach ($rows as $row) {
            switch ($type) {
                case 'diff':
                    $checksum += diff($row);
                    break;

                case 'divisible':
                    $checksum += divisible($row);
                    break;
            }
        }

        return $checksum;
    }

    function diff($row)
    {
        $cells = preg_split('/\s+/', $row);
        $max = max($cells);
        $min = min($cells);

        return $max-$min;
    }

    function divisible($row)
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
