<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptocurrencyPortfoliosTable extends Migration
{
    public function up()
    {
        Schema::create('cryptocurrency_portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->foreignId('cryptocurrency_id')->constrained('cryptocurrencies');
            $table->decimal('crypto_balance', 18, 8)->default(0);
            $table->decimal('crypto_amount', 18, 8)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cryptocurrency_portfolios');
    }
}



