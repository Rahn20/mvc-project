<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

//use App\Http\Controllers\YatzyController;

class YatzyControllerTest extends TestCase
{
    /**
     * Test yatzy page
     *
     * @return void
     */
    public function testYatzyPage()
    {
        $response = $this->get('/yatzy');
        $response->assertStatus(200)
            ->assertViewIs('yatzy');
    }

    /**
     * Test yatzy page, destroy the yatzy sessions
     *
     * @return void
     */
    public function testDestroyYatzy()
    {
        $response = $this->withSession(['yatzy.number' => 2])->get('/yatzy/destroy');
        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionMissing('yatzy.number');
    }

    /**
     * Test yatzy page, testing keep dice
     *
     * @return void
     */
    public function testKeepYatzyDice()
    {
        $response = $this->withSession([
            'yatzy.values' => [4, 15]
        ])->get('/yatzy/15');

        $response->assertStatus(302)
            ->assertRedirect('yatzy')
            ->assertSessionHas('yatzy.keepDice', [15])
            ->assertSessionHas('yatzy.values', [4]);
    }
}
