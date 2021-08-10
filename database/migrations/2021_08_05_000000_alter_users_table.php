<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role');
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('avatar');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
            $table->dropColumn('address');
            $table->dropColumn('about');
            $table->dropColumn('deleted_at');
        });
    }
}
