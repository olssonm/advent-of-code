<?php

    /**
     * @param  string  $puzzle
     * @return int
     */
    function solve(string $puzzle) : int
    {
        $cycles = 0;
        $blocks = explode("\t", $puzzle);
        $banks = count($blocks);
        $combinations = [];
        $unique = false;

        while (!$unique) {

            // Get the key for the highest value
            $pointer = array_keys($blocks, max($blocks));
            sort($pointer);
            $pointer = $pointer[0];

            $value = $blocks[$pointer]; // Get the value at pointer
            $blocks[$pointer] = 0; // Reset the block at pointer

            // To redistribute
            $redistribute = ceil($value/$banks);

            while ($value > 0) {
                $pointer++;
                if ($pointer == $banks) {
                    $pointer = 0;
                }
                $blocks[$pointer] += $redistribute;
                $value = $value - $redistribute;
            }

            $cycles++;

            $unique = in_array($blocks, $combinations);

            $combinations[] = $blocks;
        }

        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'output.txt', print_r($combinations, true));

        return $cycles;
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 387096
    exit();
