<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationTable extends Migration
{

    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('currency');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('registration');
    }
}
