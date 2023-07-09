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
        Schema::create('taskLists', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->unsignedBigInteger('board_id');
            $table->integer('limitation');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taskLists');
    }
};
