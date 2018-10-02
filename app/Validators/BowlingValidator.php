<?php

namespace App\Validators;

use InvalidArgumentException;

class BowlingValidator
{

    /**
     * Validation of all inputs
     *
     * @param $frames
     * @return Exception
     */
    public static function validate(array $frames, $framePerGame)
    {

        // we may split every condition in to a different methods if will require to add more conditions

        if (count($frames) !== $framePerGame) {
            throw new InvalidArgumentException('At least ' . $framePerGame . ' input frames required');
        }

        $lastFrame = end($frames);

        foreach ($frames as $frame) {
            if (is_array($frame) === false) {
                throw new InvalidArgumentException('Each frame need to be an array too');
            }

            foreach ($frame as $num) {
                if (is_int($num) === false || $num < 0 || $num > 10) {
                    throw new InvalidArgumentException('The value in each frame should be an integer between 0 and 10 inclusive');
                }
            }


            if ($frame !== $lastFrame) {
                if (count($frame) > 2) {
                    throw new InvalidArgumentException('Non final frame cannot exceed 2 rolls');
                }

                if ($frame[0] === 10 && count($frame) > 1) {
                    throw new InvalidArgumentException("If 1st roll in a non last frame is 10, there shouldn't be another roll in the same frame");
                }

                if (array_sum($frame) > 10) {
                    throw new InvalidArgumentException("Each frame sum before the last shouldn't exceed 10");
                }
            }

            // else part ($frame === $lastFrame)
            if (count($frame) > 3) {
                throw new InvalidArgumentException('The final frame cannot exceed 3 rolls');
            }

            if ($frame[0] !== 10 && count($frame) > 2) {
                throw new InvalidArgumentException('The final frame cannot exceed 2 rolls without at least 1 strike');
            }
        }

    }

}
