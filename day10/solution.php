<?php

    /**
     * @param  string  $puzzle
     * @return string
     */
    function solve(string $puzzle) : string
    {
        $limit = 256;
        $lengths = explode(',', $puzzle);
        $numbers = range(0, $limit);
        $skip = 0;
        $start = 0;

        foreach ($lengths as $length) {

            $mem = [];
            for ($i = 0; $i < $length; $i++) {
                $mem[] = $numbers[($start + $i) % $limit];
            }

            $mem = array_reverse($mem);
            for ($i = 0; $i < $length; $i++) {
                $numbers[($start + $i) % $limit] = $mem[$i];
            }

            $start += $length + $skip;
            $skip++;
        }

        return $numbers[0] * $numbers[1];
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 38415
    exit();
