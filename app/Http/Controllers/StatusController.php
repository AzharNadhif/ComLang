<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = Status::all();
        // $kategori = Kategori::all();
        return view('admin.status', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_status' => 'required|string|max:255' // Sesuaikan dengan nama field di model
            ]);

            Status::create([
                'nama_status' => $request->nama_status
            ]);

            return redirect()->back()->with('success', 'Status berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan Status! ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_status' => 'required|string|max:255'
            ]);

            $status = Status::findOrFail($id);
            $status->nama_status = $request->nama_status;
            $status->save();

            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui Status! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $status = Status::findOrFail($id);
            
            $status->delete();
            return redirect()->back()->with('success', 'Status berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus status! ' . $e->getMessage());
        }
    }
}
