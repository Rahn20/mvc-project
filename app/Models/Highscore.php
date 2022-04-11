<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highscore extends Model
{
    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'highscore';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @var string
     * the winner of Game21
     */
    protected $winner;

    /**
     * @var integer
     * the score of the winner in game21
     */
    protected $score;

    /**
     * @var string
     * the created time
     */
    protected $created;

    /**
     * @var integer
     * the primarykey
     */
    protected $id;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['winner', 'score', 'created'];
}
