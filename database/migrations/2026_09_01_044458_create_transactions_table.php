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
       Schema::create('transactions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('invoice_code')->unique();

        $table->date('visit_date');

        $table->integer('adult_quantity')->default(0);
        $table->integer('child_quantity')->default(0);

        $table->decimal('adult_price', 12, 2)->default(0);
        $table->decimal('child_price', 12, 2)->default(0);

        $table->decimal('total_price', 12, 2);

        $table->string('payment_proof')->nullable();

        $table->enum('status', [
            'pending',
            'lunas',
            'ditolak'
        ])->default('pending');

        $table->timestamps();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
