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
        Schema::create('serial_links', function (Blueprint $table) {
            $table->id();
            $table->text('link_serial')->nullable();
            $table->string('title_session')->nullable();
            $table->string('title_quality')->nullable();
            $table->string('title_part')->nullable();
            $table->text('link_download')->nullable();
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
        Schema::dropIfExists('serial_links');
    }
};
