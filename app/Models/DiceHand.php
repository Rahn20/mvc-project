<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand extends Model
{
    /**
     * @var Array (Dice) $dices     Array consisting of dices.
     * @var int $sum                The sum of the values
     * @var Array $values           Array consisting of last roll of the dices.
     */
    private array $dices;
    private $sum = 0;
    private $values = [];


    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $number Number of dices to create
     * @return void
     */
    public function __construct(int $number)
    {
        for ($i = 0; $i < $number; $i++) {
            $this->dices[$i] = new Dice();
            $this->values[] = null;
        }
    }

    /**
     * roll dices, save the values in the values-object and sum the values
     * @return void
    */
    public function rollDices()
    {
        $count = count($this->dices);

        for ($i = 0; $i < $count; $i++) {
            $this->dices[$i]->roll();
            $lastRoll = $this->dices[$i]->getLastRoll();
            $this->sum += $lastRoll;
            $this->values[$i] += $lastRoll;
        }
    }

    /**
     * Get the sum of all dices.
     * @return int the sum
    */
    public function getTheSum(): int
    {
        return $this->sum;
    }


    /**
     * Get last roll
     * @return string with dice values
    */
    public function getLastRoll(): string
    {
        return implode(", ", $this->values);
    }

    /**
     * Get the values of dices.
     * @return array values
    */
    public function getValues(): array
    {
        return $this->values;
    }
}
