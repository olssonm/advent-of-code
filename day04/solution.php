<?php

    /**
     * @param  string  $puzzle
     * @param  bool $doubleSecurity
     * @return int
     */
    function solve(string $puzzle, bool $doubleSecurity = false) : int
    {
        $invalid = 0;
        $passphrases = explode(PHP_EOL, $puzzle);

        foreach ($passphrases as $passphrase) {
            $words = explode(' ', $passphrase);

            if (count($words) != count(array_unique($words))) {
                $invalid++;
            } elseif ($doubleSecurity && containsAnagram($passphrase)) {
                $invalid++;
            }
        }

        return count($passphrases) - $invalid;
    }

    /**
     * Find anagrams in the passphrase
     * @param  string $passphrase
     * @return bool
     */
    function containsAnagram(string $passphrase) : bool
    {
        $passphrase = explode(' ', $passphrase);

        for ($i=0; $i < count($passphrase); $i++) {
            for ($j=0; $j < count($passphrase); $j++) {
                if (count_chars($passphrase[$i], 1) === count_chars($passphrase[$j], 1) && $i != $j) {
                    return true;
                }
            }
        }

        return false;
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 451
    echo sprintf("Solution Part 2: %s \n", solve($input, true)); // 223
    exit();
