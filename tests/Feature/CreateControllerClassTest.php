<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\GameController;
use App\Http\Controllers\YatzyController;
use App\Http\Controllers\HighscoreController;
use App\Http\Controllers\HistogramController;
use App\Http\Controllers\YatzyProtocolController;

class CreateControllerClassTest extends TestCase
{
    /**
     * Try to create the GameController class.
     *
     * @return void
     */
    public function testCreateGameClass()
    {
        $controller = new GameController();
        $this->assertInstanceOf("\App\Http\Controllers\GameController", $controller);
    }

    /**
     * Try to create the YatzyController class.
     *
     * @return void
     */
    public function testCreateYatzyClass()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("\App\Http\Controllers\YatzyController", $controller);
    }


    /**
     * Try to create the HighscoreController class.
     *
     * @return void
     */
    public function testCreateHighscoreClass()
    {
        $controller = new HighscoreController();
        $this->assertInstanceOf("\App\Http\Controllers\HighscoreController", $controller);
    }

    /**
     * Try to create the HistogramController class.
     *
     * @return void
     */
    public function testCreateHistogramClass()
    {
        $controller = new HistogramController();
        $this->assertInstanceOf("\App\Http\Controllers\HistogramController", $controller);
    }


    /**
     * Try to create the YatzyProtocolController class.
     *
     * @return void
     */
    public function testCreateYatzyProtocolClass()
    {
        $controller = new YatzyProtocolController();
        $this->assertInstanceOf("\App\Http\Controllers\YatzyProtocolController", $controller);
    }
}
