<?php

    /**
     * @param  string  $puzzle
     * @param  boolean $doubleSecurity
     * @return int
     */
    function solve(string $puzzle, bool $doubleSecurity = false) : int
    {
        $valid = 0;
        $passphrases = explode(PHP_EOL, $puzzle);

        foreach ($passphrases as $passphrase) {
            if (str_word_count($passphrase) == checkUniqueWords($passphrase)) {
                if ($doubleSecurity && checkAnagram($passphrase)) {
                    continue;
                }
                $valid ++;
            }
        }

        return $valid;
    }

    /**
     * Check how many unique words a phrase contains
     * @param  string $passphrase
     * @return int
     */
    function checkUniqueWords(string $passphrase) : int
    {
        $passphrase = explode(' ', $passphrase);
        $words = array_unique($passphrase);
        return count($words);
    }

    /**
     * Find anagrams in the passphrase
     * @param  string $passphrase
     * @return bool
     */
    function checkAnagram(string $passphrase) : bool
    {
        $detected = 0;
        $passphrase = explode(' ', $passphrase);

        for ($i=0; $i < count($passphrase); $i++) {
            for ($j=0; $j < count($passphrase); $j++) {
                if (count_chars($passphrase[$i], 1) === count_chars($passphrase[$j], 1) && $i != $j) {
                    $detected ++;
                }
            }
        }

        return ($detected > 0);
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 451
    echo sprintf("Solution Part 2: %s \n", solve($input, true)); // 223
    exit();
