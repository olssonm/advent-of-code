<?php

    /**
     * @param  string  $puzzle
     * @return int
     */
    function solve(string $puzzle, bool $debug = false) : int
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

            // Use hashes to more easily find duplicate keys
            $unique = in_array(hashArray($blocks), $combinations);
            $combinations[] = hashArray($blocks);
        }

        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'output.txt', print_r($combinations, true));

        if ($debug) {
            $unique = array_unique($combinations);
            $duplicates = array_diff_assoc($combinations, $unique);
            $result = array_diff($unique, $duplicates);
            $uniqueKeys = array_keys($result);
            $duplicateKeys = array_keys(array_intersect($combinations, $duplicates));
            return $duplicateKeys[1] - $duplicateKeys[0];
        }

        return $cycles;
    }

    /**
     * Serielize and md5-hash arrays
     * @param  array  $value
     * @return string        
     */
    function hashArray(array $value) : string
    {
        return md5(serialize($value));
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 11137
    echo sprintf("Solution Part 2: %s \n", solve($input, true)); // 1037
    exit();
