<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPesananTable extends Migration
{
    public function up()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->string('nama_penerima')->nullable()->after('alamat');
            $table->string('whatsapp', 50)->nullable()->after('nama_penerima');
            $table->string('kode_pos', 10)->nullable()->after('whatsapp');
        });
    }

    public function down()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['nama_penerima', 'whatsapp', 'kode_pos']);
        });
    }
}
