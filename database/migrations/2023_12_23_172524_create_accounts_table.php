<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{


    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->unique();
            $table->foreignId('user_id')->constrained('registration');
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
