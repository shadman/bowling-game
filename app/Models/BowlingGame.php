<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Validators\BowlingValidator;

class BowlingGame extends Model
{
    const FRAMES_PER_GAME = 10;

    /**
     * @var array
     */
    protected $inputFrames;

    /**
     * @var array
     */
    protected $rolls;


    public function setInputFrames(array $frames)
    {
        BowlingValidator::validate($frames, self::FRAMES_PER_GAME);
        $this->inputFrames = $frames;
        $this->rolls = array_collapse($frames);

        return $this;
    }

    /**
     * @return array the score history of the game. Spare points are not required.
     */
    public function getScoreHistory(): array
    {
        $scoreHistory = [];
        $rollIndex = 0;
        $totalScore = 0;

        for ($i = 0; $i < self::FRAMES_PER_GAME; $i++) {
            if ($this->isStrike($rollIndex)) {
                $totalScore += 10 + $this->strikeBonus($rollIndex);
                $rollIndex++;
            } else {

                // Spares are not considered in this game as stated in instructions

                $totalScore += $this->getDefaultFrameScore($rollIndex);
                $rollIndex += 2;
            }

            $scoreHistory[] = $totalScore;
        }

        return $scoreHistory;
    }

    /**
     * Return is striked 
     *
     * @param $rollIndex
     * @return boolean
     */
    private function isStrike(int $rollIndex): bool
    {
        return $this->rolls[$rollIndex] === 10;
    }

    /**
     * Return strike bonus points
     *
     * @param $rollIndex
     * @return int
     */
    private function strikeBonus(int $rollIndex): int
    {
        return $this->rolls[$rollIndex + 1] + $this->rolls[$rollIndex + 2];
    }

    /**
     * Return default sum of the two rolls for a frame.
     *
     * @param $rollIndex
     * @return int
     */
    private function getDefaultFrameScore(int $rollIndex): int
    {
        return $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
    }

}
