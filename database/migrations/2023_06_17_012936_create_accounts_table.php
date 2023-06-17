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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('email', 50);
            $table->string('password', 100);
            $table->text('address')->nullable();
            $table->text('avatar');
            $table->string('token', 100)->nullable();
            $table->integer('is_admin')->default(0);
            $table->integer('status')->default(0);
            $table->dateTime('deleted_at')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
