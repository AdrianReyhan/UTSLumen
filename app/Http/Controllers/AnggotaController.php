<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    // Method to fetch all anggota
    public function index()
    {
        $anggota = Anggota::all();

        return response()->json([
            'success' => true,
            'message' => 'Data semua anggota',
            'data' => $anggota
        ], 200);
    }

    // Method to fetch a single anggota by ID
    public function show($id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Anggota ditemukan',
            'data' => $anggota
        ], 200);
    }

    // Method to store a new anggota
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255', // Updated to alamat instead of email
            'telepon' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $anggota = Anggota::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,  // Save alamat
            'telepon' => $request->telepon,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil dibuat',
            'data' => $anggota
        ], 201);
    }

    // Method to update anggota information
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255', // Make alamat nullable for updates
            'telepon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $anggota = Anggota::find($id);

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota tidak ditemukan'
            ], 404);
        }

        // Update anggota fields
        $anggota->nama = $request->has('nama') ? $request->nama : $anggota->nama;
        $anggota->alamat = $request->has('alamat') ? $request->alamat : $anggota->alamat; // Update alamat
        $anggota->telepon = $request->has('telepon') ? $request->telepon : $anggota->telepon;
        $anggota->save();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil diperbarui',
            'data' => $anggota
        ], 200);
    }

    // Method to delete an anggota
    public function destroy($id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota tidak ditemukan'
            ], 404);
        }

        $anggota->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil dihapus'
        ], 200);
    }
}
