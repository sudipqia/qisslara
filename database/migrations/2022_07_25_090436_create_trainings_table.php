<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('training_categories')->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->string('page_title')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('article_tag')->nullable();
            $table->string('header')->nullable();
            $table->text('sub_header')->nullable();
            $table->longtext('description')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('archive')->default(0);
            $table->date('event_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('trainings');
    }
}
