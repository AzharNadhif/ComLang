<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Status;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::with(['status', 'pembayaran', 'user', 'detail.produk', 'produk'])->get();
        $status = Status::all();
        return view('admin.pesanan', compact('pesanan', 'status'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_status' => 'required|exists:status,id_status'
            ]);

            $pesanan = Pesanan::findOrFail($id);
            $pesanan->id_status = $request->id_status;
            $pesanan->save();

            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui status pesanan! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->delete(); // atau forceDelete jika pakai SoftDeletes
            return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus pesanan! ' . $e->getMessage());
        }
    }

}