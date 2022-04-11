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
        if (Schema::hasTable('highscore')) {
            // The "hightscore" table exists...
        } else {
            Schema::create('highscore', function (Blueprint $table) {
                $table->id()->autoIncrement();
                $table->string('winner', 8);
                $table->integer('score');
                $table->timestamp('created')->useCurrent();

                $table->engine = 'InnoDB';
                $table->charset = 'utf8mb4';
                //$table->timestamps();
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
        Schema::dropIfExists('highscore');
    }
};
