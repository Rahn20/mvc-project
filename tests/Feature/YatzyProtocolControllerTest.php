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
    public function testSaveYatzyPart1Protocol()
    {
        $response = $this->get('/yatzy/save_part_1/0/2');
        $response->assertStatus(302)
            ->assertRedirect('yatzy');

        $response1 = $this->withSession(['yatzy.saveDice' => [4, 4, 10, 12, 9]])->get('/yatzy/save_part_1/1/2');
        $response1->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.bonus', 0);

        $response2 = $this->withSession(['yatzy.saveDice' => [4, 4, 10, 20, 30]])->get('/yatzy/save_part_1/1/2');
        $response2->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.bonus', 50);
    }


    /**
     * Test yatzyprotocol
     *
     * @return void
     */
    public function testSaveYatzyPart2Protocol()
    {
        // testing one Pair
        $response = $this->get('/yatzy/save_part_2/1/4');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveOnePair', 4);

        // testing two pairs
        $response1 = $this->get('/yatzy/save_part_2/2/12');
        $response1->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveTwoPairs', 12);

        // testing Three of a Kind
        $response2 = $this->get('/yatzy/save_part_2/3/15');
        $response2->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveThree', 15);

        // testing Four of a Kind
        $response3 = $this->get('/yatzy/save_part_2/4/0');
        $response3->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveFour', 0);
    }


    /**
     * Test yatzyprotocol
     *
     * @return void
     */
    public function testSaveYatzyPart2Protocol2()
    {
        // testing Small Straight
        $response4 = $this->get('/yatzy/save_part_2/5/15');
        $response4->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveSmallStraight', 15);

        // testing Large Straigh
        $response5 = $this->get('/yatzy/save_part_2/6/20');
        $response5->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveLargeStraight', 20);

        // testing Full House
        $response6 = $this->get('/yatzy/save_part_2/7/28');
        $response6->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveFullHouse', 28);

        // testing chance
        $response7 = $this->get('/yatzy/save_part_2/8/15');
        $response7->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.saveChance', 15);

        // testing yatzy
        $response8 = $this->get('/yatzy/save_part_2/9/0');
        $response8->assertRedirect('yatzy')
        ->assertSessionHas('yatzy.saveYatzy', 0);
    }


    /**
     * Test yatzyprotocol
     *
     * @return void
     */
    public function testSaveYatzy()
    {
        $response = $this->withSession([
            'yatzy.saveDice' => [4, 4, 10, 20, 30, 5], // 73
            'yatzy.saveDicePart2' => [10, 12, 15, 15, 20, 28, 15, 50], //165 points
            'yatzy.sum' => 73,
        ])->get('/yatzy/save_part_2/9/50'); // + 50 points = 215 points

        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.finalResult', 288);
    }
}
