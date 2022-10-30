<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoDataToBlogAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_authors', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('site_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_article_tag')->nullable();
            $table->text('meta_script')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_authors', function (Blueprint $table) {
            //
        });
    }
}
