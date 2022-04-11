<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\HighscoreController;
use App\Models\Highscore;
use App\Models\YatzyHighscore;

use function PHPUnit\Framework\assertEquals;

class HighscoreControllerTest extends TestCase
{
    /**
     * Create fake Highscore data to test, adds data to the database
     * @return void
     */
    protected function createData()
    {
        $insertTestData = Highscore::create([
            'winner' => 'Dator',
            'score' => 21
        ]);

        $insertTestData = Highscore::create([
            'winner' => 'Spelare',
            'score' => 19
        ]);

        $insertTestData->save();
    }


    /**
     * Create fake Yatzy Highscore data to test, adds data to the database
     * @return void
     */
    protected function createYatzyData()
    {
        $insertTestData = YatzyHighscore::create([
            'score' => 300
        ]);

        $insertTestData = YatzyHighscore::create([
            'score' => 200
        ]);

        $insertTestData->save();
    }

    /**
     * Test highscore page, the view-page
     *
     * @return void
     */
    public function testHighscorePage()
    {
        $this->createData();

        $response = $this->get('/highscore');
        $response->assertStatus(200)
            ->assertViewIs('highscore');
    }

    /**
     * Test highscore page, the GET request
     *
     * @return void
     */
    public function testYatzyHighscorePage()
    {
        $this->createYatzyData();

        $response = $this->get('/highscore');
        $response->assertStatus(200)
            ->assertViewIs('highscore');
    }

    /**
     * Test highscore page, delete a row data 'BY id' in the Highscore table
     *
     * @return void
     */
    public function testDeleteGameHighscore()
    {
        $game = new HighscoreController();
        $getScoresBefore = $game->getAllScores();
        $countGamesBefore = count($getScoresBefore);
        $id = $getScoresBefore[0]['id'];

        $response = $this->get("/highscore/$id");
        $response->assertStatus(302)
            ->assertRedirect('highscore');

        //check that the data has been deleted.
        $game2 = new HighscoreController();
        $getScoresAfter = $game2->getAllScores();
        $countGamesAfter = count($getScoresAfter);
        assertEquals($countGamesAfter, $countGamesBefore - 1);
    }

    /**
     * Test highscore page, delete a row data 'BY id' in the yatzy_highscore table
     *
     * @return void
     */
    public function testDeleteYatzyHighscore()
    {
        $game = new HighscoreController();
        $getScoresBefore = $game->yatzyGetAllScores();
        $countGamesBefore = count($getScoresBefore);
        $id = $getScoresBefore[0]['id'];

        $response = $this->get("/highscore/yatzy/$id");
        $response->assertStatus(302)
            ->assertRedirect('highscore');


        //check that the data has been deleted.
        $game2 = new HighscoreController();
        $getScoresAfter = $game2->yatzyGetAllScores();
        $countGamesAfter = count($getScoresAfter);
        assertEquals($countGamesAfter, $countGamesBefore - 1);
    }
}
