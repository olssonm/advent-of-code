<?php

    const TYPE_DEFAULT = 1;
    const TYPE_GARBAGE = 2;
    const TYPE_IGNORE = 3;

    /**
     * @param  string  $puzzle
     * @param  boolean $returnGc
     * @return string
     */
    function solve(string $puzzle, bool $returnGc = false) : string
    {
        $nest = 0;
        $score = 0;
        $gc = 0;
        $type = TYPE_DEFAULT;

        for ($i=0; $i < strlen($puzzle); $i++) {

            $character = $puzzle[$i];

            if ($type == TYPE_DEFAULT) {
                switch ($character) {
                    case '<':
                        $type = TYPE_GARBAGE;
                        continue;

                    case '{':
                        $nest++;
                        continue;

                    case '}':
                        $score += $nest--;
                        continue;
                }
            } elseif ($type == TYPE_GARBAGE) {
                switch ($character) {
                    case '!':
                        $type = TYPE_IGNORE;
                        continue;

                    case '>':
                        $type = TYPE_DEFAULT;
                        continue;

                    default:
                        $gc++;
                        continue;
                }
            } elseif ($type == TYPE_IGNORE) {
                $type = TYPE_GARBAGE;
            }
        }

        if ($returnGc == true) {
            return $gc;
        }

        return $score;
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 11846
    echo sprintf("Solution Part 2: %s \n", solve($input, true)); // 6285
    exit();
