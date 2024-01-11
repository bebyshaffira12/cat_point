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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->string('no_telfon');
            $table->string('alamat');
            $table->string('nama_hewan');
            $table->string('ciri_khusus_hewan');
            $table->string('umur_kucing');
            $table->string('jenis_kucing');
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->string('berat');
            $table->string('jenis_kelamin_kucing');
            $table->unsignedBigInteger('treatment_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('treatment_id')
                ->references('id')
                ->on('treatment')
                ->nullOnDelete();
            $table->foreign('service_id')
                ->references('id')
                ->on('service')
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
        Schema::dropIfExists('booking');
    }
};
