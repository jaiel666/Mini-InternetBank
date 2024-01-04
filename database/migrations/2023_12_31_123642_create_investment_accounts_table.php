<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('investment_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('registration');
            $table->string('account_number');
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('return_time');
            $table->decimal('return_percentage', 5, 2)->default(0);
            $table->decimal('return_amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investment_accounts');
    }
}

