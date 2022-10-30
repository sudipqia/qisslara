<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('service_sub_categories')->onDelete('cascade');
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
            $table->integer('position')->length(11);
            $table->string('hash')->length(11);
            $table->timestamps();

            $table->index(['hash', 'position', 'slug', 'category_id', 'sub_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
