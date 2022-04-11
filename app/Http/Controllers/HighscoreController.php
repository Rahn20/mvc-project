<?php

namespace App\Http\Controllers;

use App\Models\Highscore;
use App\Models\YatzyHighscore;
use Illuminate\Support\Facades\Schema;

/**
 * A HighscoreController, highscore-page
 */
class HighscoreController extends Controller
{
    private $highScoreList = [];
    private $yatzyList = [];


    public function getAllScores(): array
    {
        $counter = 0;

        if (Schema::hasTable('highscore')) {
            $highscore = Highscore::orderBy('score', 'DESC')->get();

            foreach ($highscore as $score) {
                $this->highScoreList[$counter] = [
                    'winner' => $score->winner,
                    'score' => $score->score,
                    'created' => $score->created,
                    'id' => $score->id
                ];

                $counter += 1;
            }
        }

        return $this->highScoreList;
    }

    public function deleteHighScoreById(int $id)
    {
        Highscore::where('id', $id)->delete();
        return redirect()->route('highscore');
    }


    public function yatzyGetAllScores(): array
    {
        $counter = 0;

        if (Schema::hasTable('yatzy_highscore')) {
            $highscore = YatzyHighscore::orderBy('score', 'DESC')->get();

            foreach ($highscore as $score) {
                $this->yatzyList[$counter] = [
                    'score' => $score->score,
                    'created' => $score->created,
                    'id' => $score->id
                ];

                $counter += 1;
            }
        }

        return $this->yatzyList;
    }

    public function deleteYatzyHighScore(int $id)
    {
        YatzyHighscore::where('id', $id)->delete();
        return redirect()->route('highscore');
    }
}
