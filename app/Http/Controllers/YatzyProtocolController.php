<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YatzyHighscore;

/**
 * YatzyProtocolController, yatzy-page
 */
class YatzyProtocolController extends Controller
{
    /**
     * Save part 1
     * @param  \Illuminate\Http\Request  $request
     * @param  int $key
     * @param  int $value
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePartOne(Request $request, int $key, int $value)
    {
        $request->session()->put("yatzy.dice_$key", $value);
        $request->session()->push('yatzy.saveDice', $value) ?? [];

        $this->reset($request);

        // first part
        if (count($request->session()->get('yatzy.saveDice')) == 6) {
            // the sum of the dice values
            $sum = array_sum($request->session()->get("yatzy.saveDice") ?? []);
            $request->session()->put("yatzy.sum", $sum);

            if ($sum >= 63) {
                $request->session()->put("yatzy.bonus", 50);
            } else {
                $request->session()->put("yatzy.bonus", 0);
            }
        }

        return redirect()->route('yatzy');
    }

    private function reset($request)
    {
        // reset
        $request->session()->put("yatzy.number", 0);
        $request->session()->put("yatzy.values", null);
        $request->session()->put("yatzy.sumValues", null);
        $request->session()->put("yatzy.keepDice", null);

        // second part
        $count = 1;
        while ($count <= 9) {
            $request->session()->put("yatzy.part2_$count", null);
            $count += 1;
        };
    }

    /**
     * Save part 2
     * @param  \Illuminate\Http\Request  $request
     * @param  int $key
     * @param  int $value
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePartTwo(Request $request, int $key, int $value)
    {
        $request->session()->push('yatzy.saveDicePart2', $value);

        // reset sessions
        $this->reset($request);

        // add value to session
        $this->pushToSessions($key, $request, $value);

        $part1Result = $request->session()->get('yatzy.saveDice') ?? [];
        $part2Result = $request->session()->get('yatzy.saveDicePart2') ?? [];

        if (count($part2Result) == 9 && count($part1Result) == 6) {
            $getPart1Sum = $request->session()->get('yatzy.sum');
            $getPart1Bonus = $request->session()->get('yatzy.bonus');

            $result = array_sum($part2Result) + $getPart1Bonus + $getPart1Sum;
            $request->session()->put('yatzy.finalResult', $result);

            // push the result to the database
            $this->insertYatzyScore($result);
        }

        return redirect()->route('yatzy');
    }

    private function pushToSessions(int $key, $request, $value)
    {
        if ($key == 1) {            // one pair
            $request->session()->put("yatzy.saveOnePair", $value);
        } elseif ($key == 2) {      // two pairs
            $request->session()->put("yatzy.saveTwoPairs", $value);
        } elseif ($key == 3) {      //three of a kind
            $request->session()->put("yatzy.saveThree", $value);
        } elseif ($key == 4) {      //four of a kind
            $request->session()->put("yatzy.saveFour", $value);
        } elseif ($key == 5) {      //small straight
            $request->session()->put("yatzy.saveSmallStraight", $value);
        } elseif ($key == 6) {      //large straight
            $request->session()->put("yatzy.saveLargeStraight", $value);
        } elseif ($key == 7) {      //full house
            $request->session()->put("yatzy.saveFullHouse", $value);
        } elseif ($key == 8) {      //chance
            $request->session()->put("yatzy.saveChance", $value);
        } elseif ($key == 9) {      //yatzy
            $request->session()->put("yatzy.saveYatzy", $value);
        }
    }

    private function insertYatzyScore($score): void
    {
        $insertIntoDatabase = YatzyHighscore::create([
            'score' => (int)$score
        ]);

        $insertIntoDatabase->save();
    }
}
