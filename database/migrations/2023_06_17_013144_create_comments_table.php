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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_task_id');
            $table->integer('parent_id')->default(0);
            $table->text('content');
            $table->integer('visible')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->dateTime('updated_at')->nullable();
            // $table->timestamps();

            $table->foreign('sub_task_id')->references('id')->on('subTasks')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
