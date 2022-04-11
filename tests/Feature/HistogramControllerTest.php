<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//Models
use App\Models\Highscore;
use App\Models\YatzyHighscore;

class HistogramControllerTest extends TestCase
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
     * Create fake yatzy Highscore data to test, adds data to the database
     * @return void
     */
    protected function createYatzyData()
    {
        $insertTestData = YatzyHighscore::create([
            'score' => 50
        ]);

        $insertTestData = YatzyHighscore::create([
            'score' => 100
        ]);

        $insertTestData = YatzyHighscore::create([
            'score' => 150
        ]);

        $insertTestData = YatzyHighscore::create([
            'score' => 200
        ]);

        $insertTestData = YatzyHighscore::create([
            'score' => 250
        ]);

        $insertTestData = YatzyHighscore::create([
            'score' => 300
        ]);

        $insertTestData = YatzyHighscore::create([
            'score' => 350
        ]);

        $insertTestData->save();
    }

    /**
     * Test histogram page, testing the view (http test)
     *
     * @return void
     */
    public function testHistogramPage()
    {
        $this->createData();
        $this->createYatzyData();

        $response = $this->get('/histogram');
        $response->assertStatus(200)
            ->assertViewIs('histogram');
    }
}
