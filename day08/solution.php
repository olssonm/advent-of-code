<?php

    /**
     * @param  string  $puzzle
     * @param  boolean $returnMax
     * @return string
     */
    function solve(string $puzzle, bool $returnMax = false) : string
    {
        $registerArr = [];
        $rows = explode(PHP_EOL, $puzzle);
        $max = 0;

        foreach ($rows as $row) {
            list($register, $task, $value, $if, $registerComp, $condition, $valueComp) = explode(' ', $row);

            if (!isset($registerArr[$register])) {
                $registerArr[$register] = 0;
            }
            if(!isset($registerArr[$registerComp])) {
                $registerArr[$registerComp] = 0;
            }

            $operation = "$registerArr[$registerComp] $condition $valueComp"; // Using eval() =(
            if (eval("return ($operation);")) {
                $registerArr[$register] = calculate($registerArr[$register], $value, $task);
                if ($registerArr[$register] > $max) {
                    $max = $registerArr[$register];
                }
            }
        }

        if ($returnMax) {
            return $max;
        }

        sort($registerArr);

        return $registerArr[count($registerArr)-1];
    }


    /**
     * Perform the calculation
     * @param  int    $value1
     * @param  int    $value2
     * @param  string $task
     * @return int
     */
    function calculate(int $value1, int $value2, string $task): int
    {
        if ($task == 'inc') {
            return $value1 + $value2;
        } elseif($task == 'dec') {
            return $value1 - $value2;
        }
        throw new Exception("NO MATCHING TASK", 1); // Just to test if there is other junk in there
    }

    // Use rtrim to remove new line, else we get an additional element
    $input = rtrim(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt'));

    echo sprintf("Solution Part 1: %s \n", solve($input)); // 5966
    echo sprintf("Solution Part 2: %s \n", solve($input, true)); // 6347
    exit();
