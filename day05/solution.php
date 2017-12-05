<?php

    /**
     * @param  string  $puzzle
     * @param  bool $doubleSecurity
     * @return int
     */
    function solve(string $puzzle, bool $strange = false) : int
    {
        $steps = explode(PHP_EOL, $puzzle);
        $position = 0;
        $jumps = 0;

        while ($position < count($steps)) {

            $memory = $position; // Just "hold" the value
            $position = $position + $steps[$position];

            if ($strange && $steps[$memory] >= 3) {
                $steps[$memory] -= 1;
            } else {
                $steps[$memory] += 1;
            }

            $jumps ++;
        }

        return $jumps;
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 387096
    echo sprintf("Solution Part 2: %s \n", solve($input, true)); // 28040648
    exit();
