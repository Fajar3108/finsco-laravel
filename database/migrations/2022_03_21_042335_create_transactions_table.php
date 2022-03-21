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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('sender_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('confirmed_by_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('type_id')->constrained('transaction_types');
            $table->foreignId('status_id')->constrained('transaction_statuses');
            $table->string('code')->unique();
            $table->integer('amount');
            $table->text('description')->nullable();
            $table->integer('qty')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
