<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->integer('parent')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });


        Schema::create('category_detail_video', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('detail_video_id');
            $table->foreign('detail_video_id')->references('id')->on('detail_videos')->onDelete('cascade');
            $table->primary(['category_id' , 'detail_video_id']);
        });

        Schema::create('category_detail_serial', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('detail_serial_id');
            $table->foreign('detail_serial_id')->references('id')->on('detail_serials')->onDelete('cascade');
            $table->primary(['category_id' , 'detail_serial_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_detail_serial');
        Schema::dropIfExists('category_detail_video');
        Schema::dropIfExists('categories');
    }
}
