<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateChatifyFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $primaryKey = DB::selectOne("SHOW KEYS FROM ch_favorites WHERE Key_name = 'PRIMARY'");

        if ($primaryKey) {
            Schema::table('ch_favorites', function (Blueprint $table) {
                $table->dropPrimary(); // Drop the existing primary key
            });
        }

        Schema::table('ch_favorites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('user_id');
            $table->bigInteger('favorite_id');
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
        Schema::table('ch_favorites', function (Blueprint $table) {
            $primaryKey = DB::selectOne("SHOW KEYS FROM ch_favorites WHERE Key_name = 'PRIMARY'");
            $table->dropPrimary(); // Drop the new primary key

            if (!$primaryKey) {
                $table->uuid('id')->primary();
            }
        });
    }
}
