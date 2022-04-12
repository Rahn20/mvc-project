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
     * Get yatzy values, doing 2 tests
     * properties, use one argument.
     * @return void
    */
    public function testGetAllYatzyValues(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $yatzyTest->addYatzyValues([5, 3, 4, 4]);

        $res = $yatzyTest->getYatzyValues();
        $exp = [0, 0, 3, 8, 5, 0];
        $this->assertEquals($exp, $res);

        // test 2
        $yatzyTest2 = new Yatzy(3);
        $yatzyTest2->addYatzyValues([0, 0, 0]);

        $res2 = $yatzyTest2->getYatzyValues();
        $exp2 = [0, 0, 0, 0, 0, 0];
        $this->assertEquals($exp2, $res2);
    }

    /**
     * test one pair (Two dice showing the same number). doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testOnePair(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->onePair([5, 3, 4, 4, 2]);
        $this->assertEquals(8, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->onePair([5, 3, 4, 6, 2]);
        $this->assertEquals(0, $res1);
    }

    /**
     * test two pairs (Two different pairs of dice). Doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testTwoPairs(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->twoPairs([5, 3, 4, 4, 3]);
        $this->assertEquals(14, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->twoPairs([5, 3, 3, 6, 2]);
        $this->assertEquals(0, $res1);
    }

    /**
     * test three of a kind (Three dice showing the same number). Doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testThreeOfAKind(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->threeOfaKind([5, 4, 4, 4, 3]);
        $this->assertEquals(12, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->twoPairs([5, 3, 3, 6, 2]);
        $this->assertEquals(0, $res1);
    }


    /**
     * test four of a kind (Four dices with the same number). Doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testFourOfAKind(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->fourOfaKind([4, 4, 4, 4, 3]);
        $this->assertEquals(16, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->fourOfaKind([5, 3, 3, 6, 2]);
        $this->assertEquals(0, $res1);
    }

    /**
     * test small straight (The combination 1-2-3-4-5). Doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testSmallStraight(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->smallStraight([5, 4, 3, 2, 1]);
        $this->assertEquals(15, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->smallStraight([5, 6, 6, 6, 2]);
        $this->assertEquals(0, $res1);
    }

    /**
     * test large straight (The combination 2-3-4-5-6). Doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testLargeStraight(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->largeStraight([5, 4, 3, 2, 6]);
        $this->assertEquals(20, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->largeStraight([5, 4, 3, 1, 2]);
        $this->assertEquals(0, $res1);
    }

    /**
     * test full house (Any set of three combined with a different pair). Doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testFullHouse(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->fullHouse([6, 4, 4, 6, 6]);
        $this->assertEquals(26, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->fullHouse([5, 4, 4, 6, 2]);
        $this->assertEquals(0, $res1);
    }

    /**
     * test yatzy (All five dice with the same number). Doing 2 tests, 2 different outcome
     * properties, use one argument.
     * @return void
    */
    public function testYatzy(): void
    {
        // test 1
        $yatzyTest = new Yatzy(5);
        $res = $yatzyTest->yatzy([4, 4, 4, 4, 4]);
        $this->assertEquals(50, $res);

        // test 2
        $yatzyTest1 = new Yatzy(5);
        $res1 = $yatzyTest1->yatzy([5, 4, 4, 4, 4]);
        $this->assertEquals(0, $res1);
    }
}
