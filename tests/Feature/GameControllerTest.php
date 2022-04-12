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


    /**
     * Test game21 page, test rolling 2 dices
     *
     * @return void
     */
    public function testRoll2Dices()
    {
        $response = $this->withSession([
            "play.player" => 19
        ])->post('/game', ['select' => '2', 'submit' => 'Kasta']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.graphic')
                ->assertSessionHas('play.player');
    }

    /**
     * Test game21 page, test rolling 1 dice
     *
     * @return void
     */
    public function testRoll1Dice()
    {
        $response = $this->withSession([
            "play.player" => 21
        ])->post('/game', ['select' => '1', 'submit' => 'Kasta']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.graphic')
                ->assertSessionHas('play.player');
    }

    /**
     * Test game21 page, test the new round button
     *
     * @return void
     */
    public function testNewRound1(): void
    {
        $response = $this->post('/game', ['select' => '2', 'submit' => 'Ny runda']);
        $response->assertStatus(302)
                ->assertRedirect('/game');
    }

    /**
     * Test game21 page, test the ny round button, the computer wins
     *
     * @return void
     */
    public function testNewRoundComputerWins(): void
    {
        $response = $this->withSession([
            "play.result" => "Dator vinner",
            "play.computerPoints" => 21
        ])->post('/game', ['select' => '1', 'submit' => 'Ny runda']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.computerPoints');
    }

    /**
     * Test game21 page, test the ny round button, the player wins
     *
     * @return void
     */
    public function testNewRoundPlayerWins(): void
    {
        $response = $this->withSession([
            "play.result" => "Du vinner",
            "play.player" => 20
        ])->post('/game', ['select' => '1', 'submit' => 'Ny runda']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.playerPoints');
    }

    /**
     * Test game21 page, test stop-button, get the winner
     *
     * @return void
     */
    public function testEndGamePart1(): void
    {
        $response = $this->withSession([
            "play.player" => 20,
        ])->post('/game', ['select' => '', 'submit' => 'Stanna']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.graphic')
                ->assertSessionHas('play.result');
    }

    /**
     * Test game21 page, test stop-button, get the winner
     *
     * @return void
     */
    public function testEndGamePart2(): void
    {
        $response = $this->withSession([
            "play.player" => 20,
        ])->post('/game', ['select' => '', 'submit' => 'Stanna']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.result')
                ->assertSessionHas('play.graphic');
    }

    /**
     * Test game21 page, test stop-button, get the winner
     *
     * @return void
     */
    public function testEndGamePart3(): void
    {
        $response = $this->withSession([
            "play.player" => 20,
        ])->post('/game', ['select' => '', 'submit' => 'Stanna']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.result')
                ->assertSessionHas('play.graphic');
    }

    /**
     * Test game21 page, test stop-button, get the winner
     *
     * @return void
     */
    public function testEndGamePart4(): void
    {
        $response = $this->withSession([
            "play.player" => 17,
        ])->post('/game', ['select' => '', 'submit' => 'Stanna']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.result')
                ->assertSessionHas('play.graphic');
    }

    /**
     * Test game21 page, test stop-button, get the winner
     *
     * @return void
     */
    public function testEndGamePart5(): void
    {
        $response = $this->withSession([
            "play.player" => 18,
        ])->post('/game', ['select' => '', 'submit' => 'Stanna']);

        $response->assertStatus(302)
                ->assertRedirect('/game')
                ->assertSessionHas('play.result');
    }
}
