<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\GraphicalDice;

class GraphicalDiceTest extends TestCase
{
    /**
     * Test GraphicalDice class
     * properties, use no arguments.
     *
     * @return void
     */
    public function testGraphicalDiceClass(): void
    {
        $dice = new GraphicalDice();
        $this->assertInstanceOf("\App\Models\GraphicalDice", $dice);
    }

    /**
     * Test graphical class
     * properties, use no arguments.
     */
    public function testGraphicalDice(): void
    {
        $graphic = new GraphicalDice();
        $count = 0;

        while ($count <= 5) {
            $res = $graphic->graphic($count);
            $exp = "dice-$count";
            $this->assertEquals($exp, $res);

            $count += 1;
        }
    }
}
