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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('status_pembayaran');
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->foreign('booking_id')
                ->references('id')
                ->on('booking')
                ->nullOnDelete();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')
                ->references('id')
                ->on('order')
                ->nullOnDelete();
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
        Schema::dropIfExists('invoice');
    }
};
