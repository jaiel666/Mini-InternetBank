<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('investment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('registration');
            $table->string('account_number');
            $table->decimal('balance', 10, 2);
            $table->decimal('return_percentage', 5, 2);
            $table->decimal('return_amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investment_histories');
    }
}
