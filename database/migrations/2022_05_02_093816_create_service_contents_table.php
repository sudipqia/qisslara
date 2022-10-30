<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->enum('content_type', ['Only Content', 'Only Picture', 'Left Side Picture', 'Right Side Picture']);
            $table->string('picture')->nullable();
            $table->string('picture_alter_tag')->nullable();
            $table->longtext('content')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('position')->default(0);
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
        Schema::dropIfExists('service_contents');
    }
}
