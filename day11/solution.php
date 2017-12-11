<?php

    /**
     * @param  string  $puzzle
     * @return string
     */
    function solve(string $puzzle, bool $returnMax = false) : string
    {
        $steps = explode(',', $puzzle);
        $x = $y = $max = $result = 0;

        foreach ($steps as $step) {
            if ($step == 'n') {
                $y++;
            } elseif ($step == 'ne') {
                $x++;
                $y++;
            } elseif ($step == 'se') {
                $x++;
            } elseif ($step == 's') {
                $y--;
            } elseif ($step == 'sw') {
                $x--;
                $y--;
            } elseif ($step == 'nw') {
                $x--;
           }

           $result = max([abs($x), abs($y), abs($x) - abs($y)]);

           if ($result > $max) {
               $max = $result;
           }
        }

        if ($returnMax) {
            return $max;
        }

        return $result;
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 682
    echo sprintf("Solution Part 1: %s \n", solve($input, true)); // 1406
    exit();
