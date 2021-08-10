<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->comment('1: teacher, 0: student');
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->date('brithday')->nullable();
            $table->string('address')->nullable();
            $table->text('aboutMe')->nullable();
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
            $table->dropColumn('brithday');
            $table->dropColumn('address');
            $table->dropColumn('aboutMe');
            $table->dropSoftDeletes();
        });
    }
}
