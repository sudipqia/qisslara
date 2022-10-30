<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icon')->nullable();
            $table->string('header')->nullable();
            $table->text('content')->nullable();
            $table->text('sub_content')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->boolean('open_another_tab')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('home_page_contents');
    }
}
