<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
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
            $table->string('blog_bg')->nullable();
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
        Schema::dropIfExists('news');
    }
}
