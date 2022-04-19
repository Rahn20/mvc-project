<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Yatzy;

class YatzyTest extends TestCase
{
    /**
     * Test yatzy class
     * properties, use one argument.
     *
     * @return void
     */
    public function testYatzyClass()
    {
        $diceHand = new Yatzy(5);
        $this->assertInstanceOf("\App\Models\Yatzy", $diceHand);
    }


    /**
     * Test roll dice
     * properties, use one argument.
     * @return void
    */
    public function testRollDice(): void
    {
        $yatzyTest = new Yatzy(4);
        $yatzyTest->roll();

        $res = $yatzyTest->diceHandValues();
        $this->assertEquals(4, count($res));
    }


    /**
     * Get yatzy values, first test
     * properties, use one argument.
     * @return void
    */
    public function testGetAllYatzyValuesTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $yatzyTest->addYatzyValues([5, 3, 4, 4]);

        $res = $yatzyTest->getYatzyValues();
        $exp = [0, 0, 3, 8, 5, 0];
        $this->assertEquals($exp, $res);
    }

    /**
     * Get yatzy values, second test
     * properties, use one argument.
     * @return void
    */
    public function testGetAllYatzyValuesTest2(): void
    {
        $yatzyTest = new Yatzy(3);
        $yatzyTest->addYatzyValues([0, 0, 0]);

        $res = $yatzyTest->getYatzyValues();
        $exp = [0, 0, 0, 0, 0, 0];
        $this->assertEquals($exp, $res);
    }

    /**
     * test one pair (Two dice showing the same number). First test
     * properties, use one argument.
     * @return void
    */
    public function testOnePairTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->onePair([5, 3, 4, 4, 2]);
        $this->assertEquals(8, $res);
    }

    /**
     * test one pair (Two dice showing the same number). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testOnePairTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->onePair([5, 3, 4, 6, 2]);
        $this->assertEquals(0, $res);
    }


    /**
     * test two pairs (Two different pairs of dice). First test
     * properties, use one argument.
     * @return void
    */
    public function testTwoPairsTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->twoPairs([5, 3, 4, 4, 3]);
        $this->assertEquals(14, $res);
    }



    /**
     * test two pairs (Two different pairs of dice). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testTwoPairsTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->twoPairs([5, 3, 3, 6, 2]);
        $this->assertEquals(0, $res);
    }

    /**
     * test three of a kind (Three dice showing the same number). First test
     * properties, use one argument.
     * @return void
    */
    public function testThreeOfAKindTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->threeOfaKind([5, 4, 4, 4, 3]);
        $this->assertEquals(12, $res);
    }

    /**
     * test three of a kind (Three dice showing the same number). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testThreeOfAKindTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->twoPairs([5, 3, 3, 6, 2]);
        $this->assertEquals(0, $res);
    }


    /**
     * test four of a kind (Four dices with the same number). First test
     * properties, use one argument.
     * @return void
    */
    public function testFourOfAKindTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->fourOfaKind([4, 4, 4, 4, 3]);
        $this->assertEquals(16, $res);
    }


    /**
     * test four of a kind (Four dices with the same number). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testFourOfAKindTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->fourOfaKind([5, 3, 3, 6, 2]);
        $this->assertEquals(0, $res);
    }

    /**
     * test small straight (The combination 1-2-3-4-5). First test
     * properties, use one argument.
     * @return void
    */
    public function testSmallStraightTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->smallStraight([5, 4, 3, 2, 1]);
        $this->assertEquals(15, $res);
    }


    /**
     * test small straight (The combination 1-2-3-4-5). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testSmallStraightTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->smallStraight([5, 6, 6, 6, 2]);
        $this->assertEquals(0, $res);
    }

    /**
     * test large straight (The combination 2-3-4-5-6). First test
     * properties, use one argument.
     * @return void
    */
    public function testLargeStraightTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->largeStraight([5, 4, 3, 2, 6]);
        $this->assertEquals(20, $res);
    }


    /**
     * test large straight (The combination 2-3-4-5-6). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testLargeStraightTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->largeStraight([5, 4, 3, 1, 2]);
        $this->assertEquals(0, $res);
    }

    /**
     * test full house (Any set of three combined with a different pair). First test
     * properties, use one argument.
     * @return void
    */
    public function testFullHouseTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->fullHouse([6, 4, 4, 6, 6]);
        $this->assertEquals(26, $res);
    }

    /**
     * test full house (Any set of three combined with a different pair). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testFullHouseTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->fullHouse([5, 4, 4, 6, 2]);
        $this->assertEquals(0, $res);
    }

    /**
     * test yatzy (All five dice with the same number). First test
     * properties, use one argument.
     * @return void
    */
    public function testYatzyTest1(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->yatzy([4, 4, 4, 4, 4]);
        $this->assertEquals(50, $res);
    }

    /**
     * test yatzy (All five dice with the same number). Second test, outcome should be 0
     * properties, use one argument.
     * @return void
    */
    public function testYatzyTest2(): void
    {
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->yatzy([5, 4, 4, 4, 4]);
        $this->assertEquals(0, $res);
    }
}
