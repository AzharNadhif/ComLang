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
        $pesanan = Pesanan::with(['status', 'pembayaran'])->get();
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
}