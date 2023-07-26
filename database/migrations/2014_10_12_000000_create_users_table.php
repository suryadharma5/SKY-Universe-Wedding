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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('datingCode');
            $table->string('birthDate');
            $table->string('gender');
            $table->string('phoneNumber');
            $table->string('photo')->nullable(true);
            $table->string('password');
            $table->string('email')->unique();
            $table->integer('is_admin')->default(0);
            $table->integer('is_banned')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('dating_id')->nullable()->unique();
            $table->rememberToken();
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
    }
};
