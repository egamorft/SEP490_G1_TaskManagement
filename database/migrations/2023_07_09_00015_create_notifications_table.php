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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->integer('object_type');
            $table->integer('status');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('follower');
            $table->unsignedBigInteger('object_id');
            $table->text('description')->nullable();    
            $table->timestamp('created_at')->useCurrent();
            // $table->timestamps();
            
            $table->foreign('sender_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};