<?php

namespace Modules\Peminjaman\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\Peminjaman\Http\Requests\PeminjamanRequest;
use Modules\Peminjaman\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index(): View
    {
        return view('peminjaman::index');
    }

    public function data(): JsonResponse
    {
        return response()->json(Peminjaman::latest()->get());
    }

    public function store(PeminjamanRequest $request): JsonResponse
    {
        $data = $request->safe()->except('bukti');
        $file = $request->file('bukti');
        $data['bukti_path'] = $file->store('bukti_peminjaman', 'public');
        $data['nama_bukti'] = $file->getClientOriginalName();

        $peminjaman = Peminjaman::create($data);

        return response()->json([
            'success' => 'Data peminjaman berhasil ditambahkan.',
            'data' => $peminjaman,
        ], 201);
    }

    public function show(Peminjaman $peminjaman): JsonResponse
    {
        return response()->json($peminjaman);
    }

    public function update(PeminjamanRequest $request, Peminjaman $peminjaman): JsonResponse
    {
        $data = $request->safe()->except('bukti');

        if ($request->hasFile('bukti')) {
            if ($peminjaman->bukti_path) {
                Storage::disk('public')->delete($peminjaman->bukti_path);
            }

            $file = $request->file('bukti');
            $data['bukti_path'] = $file->store('bukti_peminjaman', 'public');
            $data['nama_bukti'] = $file->getClientOriginalName();
        }

        $peminjaman->update($data);

        return response()->json(['success' => 'Data peminjaman berhasil diperbarui.']);
    }

    public function destroy(Peminjaman $peminjaman): JsonResponse
    {
        if ($peminjaman->bukti_path) {
            Storage::disk('public')->delete($peminjaman->bukti_path);
        }

        $peminjaman->delete();

        return response()->json(['success' => 'Data peminjaman berhasil dihapus.']);
    }
}
