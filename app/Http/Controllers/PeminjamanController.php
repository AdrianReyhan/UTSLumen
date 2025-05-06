<?php
// app/Http/Controllers/PeminjamanController.php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();

        return response()->json([
            'success' => true,
            'message' => 'Data semua peminjaman',
            'data' => $peminjaman
        ], 200);
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman ditemukan',
            'data' => $peminjaman
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_anggota' => 'required|integer',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjam' => 'required|numeric',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $peminjaman = Peminjaman::create([
            'id_anggota' => $request->id_anggota,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dibuat',
            'data' => $peminjaman
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|string',
            'jumlah_pinjam' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        $peminjaman->status = $request->has('status') ? $request->status : $peminjaman->status;
        $peminjaman->jumlah_pinjam = $request->has('jumlah_pinjam') ? $request->jumlah_pinjam : $peminjaman->jumlah_pinjam;
        $peminjaman->save();

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diperbarui',
            'data' => $peminjaman
        ], 200);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        $peminjaman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dihapus'
        ], 200);
    }
}
