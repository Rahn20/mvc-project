<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Highscore;
use app\Models\YatzyHighscore;

/**
 * A HistogramController, histodiagram-page
 */
class HistogramController extends Controller
{
    private $playerScore = [];
    private $computerScore = [];

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counter = 0;

        if (Schema::hasTable('highscore')) {
            foreach (Highscore::all() as $score) {
                if ($score->winner == 'Spelare') {
                    $this->playerScore[$counter] = $score->score;
                } else {
                    $this->computerScore[$counter] = $score->score;
                }

                $counter += 1;
            }
        }

        if ($counter > 0) {
            $playerResult = $this->getScoresAsPixels($this->playerScore, $counter);
            $computerResult = $this->getScoresAsPixels($this->computerScore, $counter);
        }

        $yatzy = $this->getYatzyScoreAsPixels();

        return view('histogram', ['player' => $playerResult ?? [0, 0, 0, 0, 0, 0, 0], 'computer' => $computerResult ?? [0, 0, 0, 0, 0, 0, 0], 'yatzy' => $yatzy]);
    }


    private function getScoresAsPixels($scoreList, $games): array
    {
        $countScore1 = count(array_keys($scoreList, 21)) + count(array_keys($scoreList, 20)) + count(array_keys($scoreList, 19));
        $countScore2 = count(array_keys($scoreList, 16)) + count(array_keys($scoreList, 17)) + count(array_keys($scoreList, 18));
        $countScore3 = count(array_keys($scoreList, 13)) + count(array_keys($scoreList, 14)) + count(array_keys($scoreList, 15));
        $countScore4 = count(array_keys($scoreList, 10)) + count(array_keys($scoreList, 11)) + count(array_keys($scoreList, 12));
        $countScore5 = count(array_keys($scoreList, 7)) + count(array_keys($scoreList, 8)) + count(array_keys($scoreList, 9));
        $countScore6 = count(array_keys($scoreList, 4)) + count(array_keys($scoreList, 5)) + count(array_keys($scoreList, 6));
        $countScore7 = count(array_keys($scoreList, 1)) + count(array_keys($scoreList, 2)) + count(array_keys($scoreList, 3));

        $getPx1 = round(($countScore1 / $games) * 100) * 3; // * 3 to get the pixels, ex: 60px = 20%
        $getPx2 = round(($countScore2 / $games) * 100) * 3;
        $getPx3 = round(($countScore3 / $games) * 100) * 3;
        $getPx4 = round(($countScore4 / $games) * 100) * 3;
        $getPx5 = round(($countScore5 / $games) * 100) * 3;
        $getPx6 = round(($countScore6 / $games) * 100) * 3;
        $getPx7 = round(($countScore7 / $games) * 100) * 3;

        $result = [$getPx1, $getPx2, $getPx3, $getPx4, $getPx5, $getPx6, $getPx7];

        return $result;
    }

    private function getYatzyScoreAsPixels(): array
    {
        $scores = $this->getYatzyScores();

        if ($scores[1] > 0) {
            $getPx1 = round(($scores[0][0] / $scores[1]) * 100) * 3; // (* 3) to get the pixels, ex: 60px = 20%
            $getPx2 = round(($scores[0][1] / $scores[1]) * 100) * 3;
            $getPx3 = round(($scores[0][2] / $scores[1]) * 100) * 3;
            $getPx4 = round(($scores[0][3] / $scores[1]) * 100) * 3;
            $getPx5 = round(($scores[0][4] / $scores[1]) * 100) * 3;
            $getPx6 = round(($scores[0][5] / $scores[1]) * 100) * 3;
            $getPx7 = round(($scores[0][6] / $scores[1]) * 100) * 3;
        }

        $result = [$getPx1 ?? 0, $getPx2 ?? 0, $getPx3 ?? 0, $getPx4 ?? 0, $getPx5 ?? 0, $getPx6 ?? 0, $getPx7 ?? 0];

        return $result;
    }


    private function getYatzyScores(): array
    {
        $countScore = [0, 0, 0, 0, 0, 0, 0];
        $countGames = 0;

        if (Schema::hasTable('yatzy_highscore')) {
            foreach (YatzyHighscore::all() as $score) {
                if ($score->score <= 50) {
                    $countScore[0] += 1;
                } elseif (50 < $score->score && $score->score <= 100) {
                    $countScore[1] += 1;
                } elseif (100 < $score->score && $score->score <= 150) {
                    $countScore[2] += 1;
                } elseif (150 < $score->score && $score->score <= 200) {
                    $countScore[3] += 1;
                } elseif (200 < $score->score && $score->score <= 250) {
                    $countScore[4] += 1;
                } elseif (250 < $score->score && $score->score <= 300) {
                    $countScore[5] += 1;
                } elseif (300 < $score->score && $score->score <= 374) {
                    $countScore[6] += 1;
                }

                $countGames += 1;
            }
        }

        return [$countScore, $countGames];
    }
}
