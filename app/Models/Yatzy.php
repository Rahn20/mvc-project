<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yatzy extends Model
{
    use HasFactory;

    /**
     * @var DiceHand $dicehand
     * @var Array $yatzyValues      Contains yatzy values
     */
    private DiceHand $diceHand;
    private $yatzyValues = [0, 0, 0, 0, 0, 0];


    /**
     *
     * @param int $number Number of dices to create
     * @return void
     */
    public function __construct(int $number)
    {
        $this->diceHand = new DiceHand($number);
    }

    /**
     * roll dice
     * @return void
    */
    public function roll()
    {
        $this->diceHand->rollDices();
    }


    /**
     * Get the value of DiceHand dice.
     * @return array with dice values
    */
    public function diceHandValues(): array
    {
        return $this->diceHand->getValues();
    }


    /**
     * Sum the values that has the same dice value and put them in array 'yatzyValues'.
     * @param array $values of dices
     * @return void
    */
    public function addYatzyValues(array $values)
    {
        $count = 0;
        $yatzy = [];

        $yatzy[0] = count(array_keys($values, 1));
        $yatzy[1] = count(array_keys($values, 2));
        $yatzy[2] = count(array_keys($values, 3));
        $yatzy[3] = count(array_keys($values, 4));
        $yatzy[4] = count(array_keys($values, 5));
        $yatzy[5] = count(array_keys($values, 6));

        while ($count <= 5) {
            if ($yatzy[$count] != 0) {
                $this->yatzyValues[$count] += ($count + 1) * $yatzy[$count];
            }

            $count += 1;
        }
    }

    /**
     * get yatzy values
     * @return array with values
    */
    public function getYatzyValues(): array
    {
        return $this->yatzyValues;
    }


    /**
     * Two dice showing the same number.
     * @param array $values the values of dices
     * @return int Sum of those two dice.
     */
    public function onePair(array $values)
    {
        $count = 6;
        $result = 0;

        while ($count >= 1) {
            $countValues = count(array_keys($values, $count));

            if ($countValues == 2) {
                $result = ($count * 2);
                break;
            }
            $count -= 1;
        }

        return $result;
    }

    /**
     * Two different pairs of dice.
     * @param array $values the values of dices
     * @return int Sum of dice in those two pairs.
     */
    public function twoPairs(array $values)
    {
        $count = 1;
        $result = 0;
        $counter = 0;

        while ($count <= 6) {
            $countValues = count(array_keys($values, $count));

            if ($countValues == 2) {
                $result += ($count * 2);
                $counter += 1;
            }
            $count += 1;
        }

        if ($counter == 2) {
            return $result;
        } else {
            return 0;
        }
    }

    /**
     * Three dice showing the same number.
     * @param array $values the values of dices
     * @return int Sum of those three dice.
     */
    public function threeOfaKind(array $values): int
    {
        $count = 6;
        $result = 0;

        while ($count >= 1) {
            $countValues = count(array_keys($values, $count));

            if ($countValues == 3) {
                $result = ($count * 3);
                break;
            }
            $count -= 1;
        }

        return $result;
    }

    /**
     * Four dice with the same number.
     * @param array $values the values of dices
     * @return int Sum of those four dice.
     */
    public function fourOfaKind(array $values): int
    {
        $count = 6;
        $result = 0;

        while ($count >= 1) {
            $countValues = count(array_keys($values, $count));

            if ($countValues == 4) {
                $result = ($count * 4);
                break;
            }
            $count -= 1;
        }

        return $result;
    }

    /**
     * The combination 1-2-3-4-5.
     * @param array $values the values of dices
     * @return int 15 points (sum of all the dice).
     */
    public function smallStraight(array $values): int
    {
        $one = count(array_keys($values, 1));
        $two = count(array_keys($values, 2));
        $three = count(array_keys($values, 3));
        $four = count(array_keys($values, 4));
        $five = count(array_keys($values, 5));

        if ($one == 1 && $two == 1 && $three == 1 && $four == 1 && $five == 1) {
            return 15;
        } else {
            return 0;
        }
    }

    /**
     * The combination 2-3-4-5-6.
     * @param array $values the values of dices
     * @return int 20 points (sum of all the dice).
     */
    public function largeStraight(array $values): int
    {
        $two = count(array_keys($values, 2));
        $three = count(array_keys($values, 3));
        $four = count(array_keys($values, 4));
        $five = count(array_keys($values, 5));
        $six = count(array_keys($values, 6));

        if ($two == 1 && $three == 1 && $four == 1 && $five == 1 && $six == 1) {
            return 20;
        } else {
            return 0;
        }
    }

    /**
     * Any set of three combined with a different pair.
     * @param array $values the values of dices
     * @return int Sum of all the dice.
     */
    public function fullHouse(array $values): int
    {
        $onePair = $this->onePair($values);
        $threeKind = $this->threeOfaKind($values);

        if ($onePair != 0 && $threeKind != 0) {
            return $onePair + $threeKind;
        } else {
            return 0;
        }
    }

    /**
     * All five dice with the same number.
     * @param array $values the values of dices
     * @return int 50/0 points.
     */
    public function yatzy(array $values): int
    {
        $count = 1;
        $result = 0;

        while ($count <= 6) {
            $countValues = count(array_keys($values, $count));

            if ($countValues == 5) {
                $result = 50;
                break;
            }
            $count += 1;
        }

        return $result;
    }
}
