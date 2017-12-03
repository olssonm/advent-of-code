<?php

    /**
     * @param  int $puzzle
     * @return int
     */
    function solve(int $puzzle) : int
    {
        $counter = 1;
        $turns = 0;

        $xCoordinate = 0;
        $yCoordinate = 0;

        while ($counter < $puzzle) {
            $length = (floor($turns/2)) +1;

            for ($i=0; $i < $length && $counter != $puzzle; $i++) {

                // Determine where to "turn"
                switch ($turns % 4) {
                    case 0:
                        echo "right \n";
                        $xCoordinate++;
                        break;
                    case 1:
                        echo "up \n";
                        $yCoordinate++;
                        break;
                    case 2:
                        echo "left \n";
                        $xCoordinate--;
                        break;
                    default:
                        echo "down \n";
                        $yCoordinate--;
                        break;
                }

                $counter++;
            }

            $turns++;
        }

        // Just sum up the x and y coordinates to get the "manhattan distance"
        return abs($xCoordinate) + abs($yCoordinate);
    }

    echo sprintf("Test 1: %s \n", solve(1)); // 0
    echo sprintf("Test 12: %s \n", solve(12)); // 3
    echo sprintf("Test 23: %s \n", solve(23)); // 2

    echo sprintf("Solution Part 1: %s \n", solve(347991)); // 480
    exit();
