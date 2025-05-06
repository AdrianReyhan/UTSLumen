<?php
// app/Http/Controllers/PembayaranController.php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    // Method untuk menampilkan semua pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::all();

        return response()->json([
            'success' => true,
            'message' => 'Data semua pembayaran',
            'data' => $pembayaran
        ], 200);
    }

    // Method untuk menampilkan pembayaran berdasarkan ID
    public function show($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran ditemukan',
            'data' => $pembayaran
        ], 200);
    }

    // Method untuk menyimpan pembayaran baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'jumlah_pembayaran' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $pembayaran = Pembayaran::create([
            'id_peminjaman' => $request->id_peminjaman,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'tanggal_bayar' => $request->tanggal_bayar,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dibuat',
            'data' => $pembayaran
        ], 201);
    }

    // Method untuk mengupdate pembayaran berdasarkan ID
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_pembayaran' => 'nullable|numeric',
            'tanggal_bayar' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $pembayaran->jumlah_pembayaran = $request->has('jumlah_pembayaran') ? $request->jumlah_pembayaran : $pembayaran->jumlah_pembayaran;
        $pembayaran->tanggal_bayar = $request->has('tanggal_bayar') ? $request->tanggal_bayar : $pembayaran->tanggal_bayar;
        $pembayaran->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diperbarui',
            'data' => $pembayaran
        ], 200);
    }

    // Method untuk menghapus pembayaran berdasarkan ID
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $pembayaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dihapus'
        ], 200);
    }
}
