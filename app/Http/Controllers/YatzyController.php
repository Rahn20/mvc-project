<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yatzy;

/**
 * A YatzyController, yatzy-page
 */
class YatzyController extends Controller
{
    private object $session;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function play(Request $request)
    {
        $this->session = $request->session();
        $this->setSessions();

        $number = $this->session->get('yatzy.number');
        $result = $this->session->get('yatzy.finalResult');

        if ($number <= 2 && is_null($result)) {
            $this->roll();
        };

        return redirect()->route('yatzy');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int $value the dice value
     * @return \Illuminate\Http\RedirectResponse
     */
    public function keep(Request $request, int $value)
    {
        $request->session()->push('yatzy.keepDice', $value);

        $values = $request->session()->get('yatzy.values') ?? [];

        if ($value) {
            $getIndex = array_search($value, $values);
            unset($values[$getIndex]);

            $index = array_values($values);
            $request->session()->put('yatzy.values', $index);
        }

        return redirect()->route('yatzy');
    }


    private function setSessions(): void
    {
        if ($this->session->missing('yatzy')) {
            $this->session->push('yatzy', null);
            $this->session->put('yatzy.number', 0);
            $this->session->put('yatzy.values', null);
        }
    }


    private function roll(): void
    {
        $number = $this->session->get('yatzy.number');
        $number += 1;
        $this->session->put('yatzy.number', $number);

        $values = $this->session->get('yatzy.values');
        $keepDice = $this->session->get('yatzy.keepDice') ?? [];

        if ($values == null) {
            $yatzy = new Yatzy(5);
        } else {
            $yatzy = new Yatzy(count($values));
        }

        // add values to session
        $yatzy->roll();
        $values = $yatzy->diceHandValues();
        $this->session->put('yatzy.values', $values);

        // add yatzy- and keep dice values to get the sum of the same values
        $yatzy->addYatzyValues(array_merge($values, $keepDice));
        $yatzyResult = $yatzy->getYatzyValues();
        $this->session->put('yatzy.sumValues', $yatzyResult);

        $this->addToSession($yatzy, $values, $keepDice);
    }


    private function addToSession($diceHand, $values, $keepDice): void
    {
        $onePair = $diceHand->onePair(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_1', $onePair);

        $twoPairs = $diceHand->twoPairs(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_2', $twoPairs);

        $threeOfaKind = $diceHand->threeOfaKind(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_3', $threeOfaKind);

        $fourOfaKind = $diceHand->fourOfaKind(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_4', $fourOfaKind);

        $smallStraight = $diceHand->smallStraight(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_5', $smallStraight);

        $largeStraight = $diceHand->largeStraight(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_6', $largeStraight);

        $fullHouse = $diceHand->fullHouse(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_7', $fullHouse);

        $chance = array_sum(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_8', $chance);

        $yatzy = $diceHand->yatzy(array_merge($values, $keepDice));
        $this->session->put('yatzy.part2_9', $yatzy);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyYatzy(Request $request)
    {
        $request->session()->forget('yatzy');
        return redirect()->route('yatzy');
    }
}
