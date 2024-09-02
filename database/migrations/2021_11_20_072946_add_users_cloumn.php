<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersCloumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_b')->after('nama');
            $table->unsignedBigInteger('roles_id')->after('nama_b');
            $table->bigInteger('no_HP')->after('email')->unique()->nullable();
            /*
            status
            0 > Akun baru > belum di aprrove psik
            1 > Pengguna sudah aktif
            */
            $table->boolean('status');

            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
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
            $table->renameColumn('nama', 'name');
            $table->dropColumn('nama_b');
            $table->dropForeign(['roles_id']);
            $table->dropColumn('no_HP');
            $table->dropColumn('status');
        });
    }
}
