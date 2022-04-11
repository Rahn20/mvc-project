<?php

namespace App\Models;

/**
 * Class Dice.
 */
class GraphicalDice extends Dice
{
    /**
     * @return string with dice-value
     */
    public function graphic(int $rollDice): string
    {
        return "dice-" . $rollDice;
    }
}
