<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Dice;

class DiceTest extends TestCase
{
    /**
     * Test Dice class
     * properties, use no arguments.
     *
     * @return void
     */
    public function testDiceClass()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\App\Models\Dice", $dice);
    }

    /**
     * Test roll the dice and get the value
     * properties, use no arguments.
     *
     * @return void
     */
    public function testRollDice()
    {
        $dice = new Dice();
        $dice->roll();

        $res = $dice->roll;
        $exp = $dice->getLastRoll();
        $this->assertEquals($exp, $res);
    }
}
