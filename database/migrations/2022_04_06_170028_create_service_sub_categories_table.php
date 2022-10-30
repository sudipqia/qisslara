<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('archive')->default(0);
            $table->integer('position')->length(11);
            $table->string('hash')->length(11);
            $table->timestamps();

            $table->index(['hash', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_sub_categories');
    }
}
