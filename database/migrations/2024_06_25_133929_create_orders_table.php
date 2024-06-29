<?php

use App\Enums\EnumOrderStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('track_number')->nullable();
            $table->bigInteger('tax')->default(0);
            $table->bigInteger('discount_amount')->default(0);
            $table->bigInteger('order_amount');
            $table->bigInteger('payable_amount')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default(EnumOrderStatus::CREATED); 
            $table->string('payment_type')->nullable(); // Installment or full
            $table->string('payment_method')->nullable(); // cash, credit_card, cheque, online, ..
            $table->string('gateway')->nullable(); // zarinpal, mellat, parsian , ...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
