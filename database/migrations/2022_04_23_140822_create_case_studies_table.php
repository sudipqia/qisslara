<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('picture')->nullable();
            $table->string('alt_tag')->nullable();
            $table->string('title')->nullable();
            $table->string('header')->nullable();
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
        Schema::dropIfExists('case_studies');
    }
}
