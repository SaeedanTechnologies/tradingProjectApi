<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trade_orders', function (Blueprint $table) {
            $table->id();
            $table->enum('order_type', ['market or live', 'pending', 'close']);
            $table->string('symbol');
            $table->foreignId('trading_account_id')->constrained('trading_accounts')->onDelete('cascade');
            $table->enum('type', ['buy', 'sell']);
            $table->string('volume');
            $table->string('stopLoss')->nullable();
            $table->string('takeProfit')->nullable();
            $table->string('price');
            $table->string('open_time');
            $table->string('open_price');
            $table->string('close_time')->nullable();
            $table->string('close_price')->nullable();
            $table->string('reason')->nullable();
            $table->string('swap')->nullable();
            $table->string('profit')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_orders');
    }
};