<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('header')->nullable();
            $table->text('sub_header')->nullable();
            $table->text('list_one')->nullable();
            $table->text('list_two')->nullable();
            $table->text('list_three')->nullable();
            $table->text('list_four')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->boolean('open_another_tab')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solution_cards');
    }
}
