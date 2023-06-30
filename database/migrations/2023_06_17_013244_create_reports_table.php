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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->text('reason');
            $table->unsignedBigInteger('reported');
            $table->text('image');
            $table->integer('status')->default(0);
            $table->text('response');
            // $table->timestamps();

            $table->foreign('created_by')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('reported')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
