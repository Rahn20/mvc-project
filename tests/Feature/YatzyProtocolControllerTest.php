<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class YatzyProtocolControllerTest extends TestCase
{
    /**
     * Test yatzyprotocol
     *
     * @return void
     */
    public function testSaveYatzyPart1ProtocolTest1()
    {
        $response = $this->get('/yatzy/save_part_1/0/2');
        $response->assertStatus(302)
            ->assertRedirect('yatzy');
    }

    /**
     * Test yatzyprotocol, testing save dice part 1
     *
     * @return void
     */
    public function testSaveYatzyPart1ProtocolTest2()
    {
        $response = $this->withSession(['yatzy.saveDice' => [4, 4, 10, 12, 9]])->get('/yatzy/save_part_1/1/2');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.bonus', 0);
    }

    /**
     * Test yatzyprotocol, testing save dice part 1
     *
     * @return void
     */
    public function testSaveYatzyPart1ProtocolTest3()
    {
        $response = $this->withSession(['yatzy.saveDice' => [4, 4, 10, 20, 30]])->get('/yatzy/save_part_1/1/2');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.bonus', 50);
    }


    /**
     * Test yatzyprotocol, testing save dice part 2 (one pair)
     *
     * @return void
     */
    public function testSaveYatzyProtocolOnePair()
    {
        $response = $this->get('/yatzy/save_part_2/1/4');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveOnePair', 4);
    }

    /**
     * Test yatzyprotocol, testing save dice part 2 (two pairs)
     *
     * @return void
     */
    public function testSaveYatzyProtocolTwoPairs()
    {
        $response = $this->get('/yatzy/save_part_2/2/12');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveTwoPairs', 12);
    }

    /**
     * Test yatzyprotocol, testing save dice part 2 (Three of a Kind)
     *
     * @return void
     */
    public function testSaveYatzyProtocolThreeOfAKind()
    {
        $response = $this->get('/yatzy/save_part_2/3/15');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveThree', 15);
    }

    /**
     * Test yatzyprotocol, testing save dice part 2 (Four of a Kind)
     *
     * @return void
     */
    public function testSaveYatzyProtocolFourOfAKind()
    {
        $response = $this->get('/yatzy/save_part_2/4/0');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveFour', 0);
    }


    /**
     * Test yatzyprotocol, testing save dice part 2 (Small Straight)
     *
     * @return void
     */
    public function testSaveYatzyProtocolSmallStraight()
    {
        $response = $this->get('/yatzy/save_part_2/5/15');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveSmallStraight', 15);
    }

    /**
     * Test yatzyprotocol, testing save dice part 2 (Large Straigh)
     *
     * @return void
     */
    public function testSaveYatzyProtocolLargeStraight()
    {
        $response = $this->get('/yatzy/save_part_2/6/20');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveLargeStraight', 20);
    }

    /**
     * Test yatzyprotocol, testing save dice part 2 (Full House)
     *
     * @return void
     */
    public function testSaveYatzyProtocolFullHouse()
    {
        $response = $this->get('/yatzy/save_part_2/7/28');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveFullHouse', 28);
    }

    /**
     * Test yatzyprotocol, testing save dice part 2 (chance)
     *
     * @return void
     */
    public function testSaveYatzyProtocolChance()
    {
        $response = $this->get('/yatzy/save_part_2/8/15');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveChance', 15);
    }

    /**
     * Test yatzyprotocol, testing save dice part 2 (yatzy)
     *
     * @return void
     */
    public function testSaveYatzyProtocolYatzy()
    {
        $response = $this->get('/yatzy/save_part_2/9/0');
        $response->assertRedirect('yatzy')
        ->assertSessionHas('yatzy.saveYatzy', 0);
    }


    /**
     * Test yatzyprotocol
     *
     * @return void
     */
    public function testGetYatzyFinalResult()
    {
        $response = $this->withSession([
            'yatzy.saveDice' => [4, 4, 10, 20, 30, 5], // 73
            'yatzy.saveDicePart2' => [10, 12, 15, 15, 20, 28, 15, 50], //165 points
            'yatzy.sum' => 73,
        ])->get('/yatzy/save_part_2/9/50'); // + 50 points => 73 + 165 + 50 = 288 points

        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.finalResult', 288);
    }
}
