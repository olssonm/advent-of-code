<?php

    /**
     * @param  int $puzzle
     * @return int
     */
    function solve(int $puzzle) : int
    {
        $grid = [];
        $xCoordinate = 0;
        $yCoordinate = 0;

        $right = 0;
        $up = 0;
        $left = 0;
        $down = 0;

        $stepRight = 1;
        $stepLeft = 2;
        $value = 0;

        $neighbors = [
            [0, 1],
            [1, 1],
            [1, 0],
            [1, -1],
            [0, -1],
            [-1, -1],
            [-1, 0],
            [-1, 1]
        ];

        while ($value <= $puzzle) {

            $value = 0;

            if ($xCoordinate === 0 && $yCoordinate === 0) {
                $value = 1;
            }

            foreach (neighbor($neighbors, $grid, $xCoordinate, $yCoordinate) as $i) {
                $value += $i;
            }

            $grid[$yCoordinate][$xCoordinate] = $value;

            if ($right < $stepRight) {
                $right++;
                $xCoordinate++;
            } elseif ($up < $stepRight) {
                $up++;
                $yCoordinate++;
            } elseif ($left < $stepLeft) {
                $left++;
                $xCoordinate--;
            } elseif ($down < $stepLeft) {
                $down++;
                $yCoordinate--;
            } else {
                $right = 0;
                $up = 0;
                $left = 0;
                $down = 0;
                $stepLeft += 2;
                $stepRight += 2;
            }
        }

        return $value;
    }

    /**
     * @param  array     $neighbors
     * @param  array     $grid
     * @param  int       $xCoordinate
     * @param  int       $yCoordinate
     * @return generator
     */
    function neighbor(array $neighbors, array $grid, int $xCoordinate, int $yCoordinate) : generator
    {
        foreach ($neighbors as $neighbor) {
            if (isset($grid[$yCoordinate + $neighbor[0]][$xCoordinate + $neighbor[1]])) {
                yield $grid[$yCoordinate + $neighbor[0]][$xCoordinate + $neighbor[1]];
            }
        }
    }

    echo sprintf("Solution Part 1: %s \n", solve(347991)); // 349975
