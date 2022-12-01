<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 30);
            $table->string('password', 70);
            $table->string('name', 20)->nullable();
            $table->string('surname', 20)->nullable();
            $table->string('patronymic', 20)->nullable();
            $table->date('bidth_date')->nullable();
            $table->string('about', 250)->nullable();
            $table->string('portfolio', 400)->nullable();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
            $table->string('remember_token', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropForeign('users_role_id_foreign');
        });
        Schema::dropIfExists('users');
    }
}
