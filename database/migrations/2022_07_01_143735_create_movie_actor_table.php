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
        Schema::create('movie_actor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('actor_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('character_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_actor');
    }
};
