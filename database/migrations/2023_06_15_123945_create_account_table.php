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
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->string('username', 255);
            $table->string('fullname', 50);
            $table->string('email', 100);
            $table->string('password', 100);
            $table->text('address');
            $table->text('avatar');
            $table->string('token', 100);
            $table->integer('is_admin')->default(0);
            $table->date('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account');
    }
};
