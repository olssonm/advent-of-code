<?php

    /**
     * @param  string  $puzzle
     * @return string
     */
    function solve(string $puzzle, bool $debug = false) : string
    {
        $base = null;
        $programs = [];
        $towers = explode(PHP_EOL, $puzzle);

        // Parse towers
        foreach ($towers as $tower) {

            $program = function() use ($tower) {

                $matches = [];

                if (strpos($tower, '->') !== false) {
                    preg_match('/^(.*?) \((\d+)\) -> (.*)$/', $tower, $matches);
                } else {
                    preg_match('/^(.*?) \((\d+)\)$/', $tower, $matches);
                }

                return [
                    'name' => $matches[1],
                    'weight' => $matches[2],
                    'children' => isset($matches[3]) ? array_map('trim', explode(',', $matches[3])) : [],
                ];
            };

            $programs[] = $program();
        }

        // Check programs
        foreach ($programs as $program) {
            $valid = true;
            foreach ($programs as $program2) {
                if (in_array($program['name'], $program2['children'])) {
                    $valid = false;
                }
            }
            if ($valid) {
                $base = $program['name'];
            }
        }

        return $base;
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // rqwgj
    exit();
