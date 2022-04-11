<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasTable('yatzy_highscore')) {
            // The "hightscore" table exists...
        } else {
            Schema::create('yatzy_highscore', function (Blueprint $table) {
                $table->id()->autoIncrement();
                $table->integer('score');
                $table->timestamp('created')->useCurrent();

                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yatzy_highscore');
    }
};
