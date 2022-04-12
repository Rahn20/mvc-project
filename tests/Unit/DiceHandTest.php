<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\DiceHand;

class DiceHandTest extends TestCase
{
    /**
     * Test DiceHand class
     * properties, use one argument.
     *
     * @return void
     */
    public function testDiceHandClass()
    {
        $diceHand = new DiceHand(5);
        $this->assertInstanceOf("\App\Models\DiceHand", $diceHand);
    }

    /**
     * Test roll dices and count how many dices are in the Dicehand
     * properties, use one argument.
     *
     * @return void
     */
    public function testCountDiceHand()
    {
        $diceHand = new DiceHand(3);
        $diceHand->rollDices();

        $res = $diceHand->getValues();
        $this->assertEquals(3, count($res));
    }

    /**
     * test the sum of the values
     * properties, use one argument.
     * @return void
     */
    public function testSumValues(): void
    {
        $diceHand = new DiceHand(3);
        $diceHand->rollDices();

        $res = $diceHand->getTheSum();
        $exp = array_sum($diceHand->getValues());
        $this->assertEquals($exp, $res);
    }

    /**
     * test get the values of the last roll
     * properties, use one argument.
     * @return void
     */
    public function testGetLastRoll(): void
    {
        $diceHand = new DiceHand(4);

        $res = $diceHand->getLastRoll();
        $exp = implode(", ", $diceHand->getValues());
        $this->assertEquals($exp, $res);
    }
}
