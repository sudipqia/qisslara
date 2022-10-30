<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('picture')->nullable();
            $table->string('alt_tab')->nullable();
            $table->string('title')->nullable();
            $table->string('header')->nullable();
            $table->text('content')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->boolean('open_another_tab')->default(1);
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
        Schema::dropIfExists('about_contents');
    }
}
