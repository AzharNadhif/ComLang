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
        Schema::table('pembayaran', function (Blueprint $table) {
            // Kolom untuk Midtrans integration
            $table->string('snap_token', 500)->nullable()->after('bukti_bayar');
            $table->enum('status', ['pending', 'success', 'failed', 'expired', 'cancelled', 'challenge'])->default('pending')->after('snap_token');
            $table->string('transaction_id')->nullable()->after('status');
            $table->string('order_id')->nullable()->after('transaction_id');
            $table->string('payment_type')->nullable()->after('order_id');
            $table->timestamp('payment_date')->nullable()->after('payment_type');
            
            // Ubah bukti_bayar menjadi nullable karena sekarang menggunakan Midtrans
            $table->string('bukti_bayar')->nullable()->change();
            
            // Tambah index untuk optimasi query
            $table->index('status');
            $table->index('order_id');
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Drop index terlebih dahulu
            $table->dropIndex(['status']);
            $table->dropIndex(['order_id']);
            $table->dropIndex(['transaction_id']);
            
            // Drop kolom Midtrans
            $table->dropColumn([
                'snap_token',
                'status',
                'transaction_id',
                'order_id',
                'payment_type',
                'payment_date'
            ]);
            
            // Kembalikan bukti_bayar menjadi required (jika diperlukan)
            // $table->string('bukti_bayar')->nullable(false)->change();
        });
    }
};