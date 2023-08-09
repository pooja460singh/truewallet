<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('role_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact');
            $table->string('address');
            $table->string('image');
            $table->boolean('is_super')->default(false);
            $table->rememberToken();
             $table->tinyInteger('status');
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
        Schema::dropIfExists('role_users');
    }
}
