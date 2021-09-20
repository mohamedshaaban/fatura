<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTables extends Migration
{
    /**
     * {@inheritdoc}
     */


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('uri')->nullable();
            $table->string('permission')->nullable()->references('id')->on('permissions');

            $table->timestamps();
        });

        Schema::create('role_users', function (Blueprint $table) {
            $table->integer('role_id')->references('id')->on('roles');
            $table->integer('user_id')->references('id')->on('users');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('role_id')->references('id')->on('roles');
            $table->integer('permission_id')->references('id')->on('permissions');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });

        Schema::create('user_permissions', function (Blueprint $table) {
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('permission_id')->references('id')->on('permissions');
            $table->index(['user_id', 'permission_id']);
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');

        Schema::dropIfExists('user_permissions');
        Schema::dropIfExists('role_users');
        Schema::dropIfExists('role_permissions');

    }
}
