<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dice.
 */
class Dice extends Model
{
    /**
     * Save dice value
     */
    public ?int $roll = null;

    /**
     * Roll the dice and add dice value to $roll
     * @return void
     */
    public function roll()
    {
        $this->roll = rand(1, 6);
    }

    /**
     * Return dice last roll value
     * @return int dice value
     */
    public function getLastRoll()
    {
        return $this->roll;
    }
}
