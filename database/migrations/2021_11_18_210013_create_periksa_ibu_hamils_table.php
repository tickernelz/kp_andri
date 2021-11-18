<?php

use App\Models\JadwalIbuHamil;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaIbuHamilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_ibu_hamils', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Pemeriksaan::class)->constrained();
            $table->float('berat_badan');
            $table->float('tekanan_darah');
            $table->integer('bulan_kehamilan');
            $table->float('tinggi_fundus');
            $table->float('denyut_jantung_janin');
            $table->float('lingkar_lengan_atas');
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
        Schema::dropIfExists('periksa_ibu_hamils');
    }
}
