<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('blog_authors')->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('site_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_article_tag')->nullable();
            $table->text('meta_script')->nullable();
            $table->string('header')->nullable();
            $table->text('sub_header')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('tags')->nullable();
            $table->string('main_photo_alt_tag')->nullable();
            $table->string('cover_photo_alter_tag')->nullable();
            $table->longtext('content')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('is_archived')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
