<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaLansiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_lansias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Pemeriksaan::class)->constrained()->onDelete('cascade');
            $table->float('berat_badan');
            $table->float('tekanan_darah');
            $table->float('gula_darah');
            $table->float('kolesterol');
            $table->float('asam_urat');
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
        Schema::dropIfExists('periksa_lansias');
    }
}
