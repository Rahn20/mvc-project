<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\YatzyController;
use App\Http\Controllers\HighscoreController;
use App\Http\Controllers\YatzyProtocolController;
use App\Http\Controllers\HistogramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// index page
Route::view('/', 'home')->name('home');


// Game21 routes
Route::view('/game', 'game')->name('game');
Route::post('/game', [ GameController::class, 'play' ])->name('play-game');
Route::get('/game/destroy', [ GameController::class, 'destroyGame' ])->name('destroy-game');

// yatzy routes
Route::view('/yatzy', 'yatzy')->name('yatzy');
Route::post('/yatzy', [ YatzyController::class, 'play' ])->name('play-yatzy');
Route::get('/yatzy/destroy', [ YatzyController::class, 'destroyYatzy' ])->name('destroy-yatzy');

Route::get('/yatzy/{value}', [YatzyController::class, 'keep'])->name('yatzy_play');

// yatzy protocol routes
Route::get('/yatzy/save_part_1/{key}/{value}', [YatzyProtocolController::class, 'savePartOne'])->name('yatzy_save');
Route::get('/yatzy/save_part_2/{key}/{value}', [YatzyProtocolController::class, 'savePartTwo'])->name('yatzy_save_part_2');


//highScore for Game21
$scores = new HighscoreController();
Route::view('/highscore', 'highscore', ['scores' => $scores->getAllScores(), 'yatzyScore' => $scores->yatzyGetAllScores()])->name('highscore');
Route::get('/highscore/{id}', [ HighscoreController::class, 'deleteHighScoreById' ])->name('delete-one');
Route::get('/highscore/yatzy/{id}', [ HighscoreController::class, 'deleteYatzyHighScore' ])->name('deleteYatzy-one');

// histogram route
Route::get('/histogram', [ HistogramController::class, 'index' ])->name('histogram');
