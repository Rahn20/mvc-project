<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dice;
use App\Models\DiceHand;
use App\Models\GraphicalDice;
use App\Models\Highscore;

/**
 * A GameController, game21-page
 */
class GameController extends Controller
{
    private int $select;
    private object $session;

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function play(Request $request)
    {
        $submit = $request->input('submit');
        $this->select = (int) $request->input('select');
        $this->session = $request->session();

        $this->setSessions();
        $result = $this->session->get('play.result');
        $rounds = $this->session->get('play.rounds');

        if ($submit == 'Stanna' && $result == null) {
            $this->stop();
        } elseif ($submit == "Kasta" && $result == null) {
            $this->roll();
        } elseif ($submit == "Ny runda") {
            $rounds += 1;
            $this->session->put('play.rounds', $rounds);
            $this->newRound();
        }

        $this->winner();
        return redirect()->route('game');
    }

    private function winner(): void
    {
        $result = $this->session->get('play.result');

        if (is_null($result)) {
            if ($this->session->get('play.player') == 21) {
                $this->result("Grattis!! Du vann");
                $this->insertNewScore('Spelare', 21);
            } elseif ($this->session->get('play.player') > 21) {
                $this->result("Du förlorade");
            }
        }
    }


    private function result($res = null): void
    {
        $this->session->forget('play.graphic');
        $this->session->push('play.graphic', null);
        $this->session->put('play.result', $res);
    }

    private function setSessions(): void
    {
        if ($this->session->missing('play')) {
            $this->session->push('play', null);
            $this->session->put('play.player', 0);
            $this->session->put('play.computer', 0);
            $this->session->put('play.result', null);
        }
    }

    private function insertNewScore($winner, $score): void
    {
        $insertIntoDatabase = Highscore::create([
            'winner' => $winner,
            'score' => (int)$score
        ]);

        $insertIntoDatabase->save();
    }

    private function stop(): void
    {
        $player = $this->session->get('play.player');
        $computer = $this->session->get('play.computer');
        $this->session->forget('play.graphic');
        $roll = [];

        while ($computer < 21 || $computer < 19) {
            $dice = new Dice();
            $dice->roll();
            $lastRoll = $dice->getLastRoll();

            array_push($roll, $lastRoll);
            $computer = $this->session->get('play.computer') + $lastRoll;
            $this->session->put('play.computer', $computer);
        }

        $graphic = new GraphicalDice();

        foreach ($roll as $value) {
            $gDice = $graphic->graphic($value);
            $this->session->push('play.graphic', $gDice);
        }

        $this->pushToSessions($computer, $player);
    }


    private function pushToSessions(int $computer, int $player)
    {
        if ($computer == 21) {
            $this->session->put('play.result', "Dator vinner");
            $this->insertNewScore('Dator', $computer);
        } elseif ($player < $computer && $computer < 21) {
            $this->session->put('play.result', "Dator vinner");
            $this->insertNewScore('Dator', $computer);
        } elseif ($player > $computer && $player < 21) {
            $this->session->put('play.result', "Du vinner");
            $this->insertNewScore('Spelare', $player);
        } elseif ($player == $computer) {
            $this->session->put('play.result', "Dator vinner");
            $this->insertNewScore('Dator', $computer);
        } elseif ($computer > 21) {
            $this->session->put('play.result', "Du vinner");
            $this->insertNewScore('Spelare', $player);
        }
    }

    private function roll(): void
    {
        $player = $this->session->get('play.player');
        $this->session->forget('play.graphic');

        if ($player < 21) {
            $graphic = new GraphicalDice();
            $diceHand = new DiceHand($this->select);
            $diceHand->rollDices();

            $this->session->put('play.hand', $diceHand->getLastRoll());
            $sum = $diceHand->getTheSum();

            $player = $this->session->get('play.player') + $sum;
            $this->session->put('play.player', $player);

            $graphicResult1 = $graphic->graphic((int)$this->session->get('play.hand'));
            $this->session->push('play.graphic', $graphicResult1);

            if ($this->select == 2) {
                $graphicResult2 = $graphic->graphic($this->session->get('play.hand')[3]);
                $this->session->push('play.graphic', $graphicResult2);
            };
        }
    }

    private function newRound(): void
    {
        $computerPoints = $this->session->get('play.computerPoints');
        $playerPoints = $this->session->get('play.playerPoints');
        $result = $this->session->get('play.result');

        if ($result == "Dator vinner") {
            $computerPoints += $this->session->get('play.computer');
            $this->session->put('play.computerPoints', $computerPoints);
        } elseif ($result == "Grattis!! Du vann" || $result == "Du vinner") {
            $playerPoints += $this->session->get('play.player');
            $this->session->put('play.playerPoints', $playerPoints);
        }

        $this->result();
        $this->session->put('play.hand', null);
        $this->session->put('play.player', 0);
        $this->session->put('play.computer', 0);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyGame(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('game');
    }
}
