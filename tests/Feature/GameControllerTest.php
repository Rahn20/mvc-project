<?php

namespace Tests\Feature;

use App\Http\Controllers\GameController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    /**
     * Test game21 page, testing http
     *
     * @return void
     */
    public function testGamePage()
    {
        $response = $this->get('/game');
        $response->assertStatus(200)
            ->assertViewIs('game');
    }


    /**
     * Test game21 page, destroy the game/testing sessions
     *
     * @return void
     */
    public function testDestroyGame()
    {
        $response = $this->withSession(['testing' => 5])->get('/game/destroy');
        $response->assertSessionMissing('testing')
                ->assertRedirect('/game');
    }
}
