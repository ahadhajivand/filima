<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_serials', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('image')->nullable();
            $table->string('imdb')->nullable();
            $table->string('genre_one')->nullable();
            $table->string('genre_two')->nullable();
            $table->string('genre_three')->nullable();
            $table->string('year')->nullable();
            $table->string('country')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('language')->nullable();
            $table->string('time')->nullable();
            $table->text('age_category')->nullable();
            $table->text('link_serial')->nullable();
            $table->string('slug')->nullable();
            $table->text('category')->default('سریال');
            $table->boolean('status')->default(0);
            $table->boolean('special')->default(0);
            $table->boolean('new')->default(0);
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
        Schema::dropIfExists('detail_serials');
    }
};
