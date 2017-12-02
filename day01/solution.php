<?php

    /**
     * @param  string $puzzle
     * @param  integer $offset
     * @return integer
     */
    function solve($puzzle, $offset = null)
    {
        $sum = 0;
        $puzzle = str_split($puzzle);
        $count = count($puzzle);

        foreach ($puzzle as $key => $value) {

            $index = null;
            if ($offset) {
                $index = ($key + $offset) % $count;
            } else {
                $index = ($key === $count -1) ? 0 : $key +1;
            }

            if ($value == $puzzle[$index]) {
                $sum += $value;
            }
        }

        return $sum;
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 1049
    echo sprintf("Solution Part 2: %s \n", solve($input, strlen($input) / 2)); // 1508
    exit();
