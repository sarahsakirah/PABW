<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporBanjirController extends Controller
{
    public function index()
    {
        return view('laporan.index', ['laporan' => Laporan::latest()->get()]);
    }

    public function formlaporbanjir()
    {
        return view('formlaporbanjir');
    }

    public function proseslaporbanjir(Request $request)
    {
        $data = $request->validate([
            'nama_pelapor' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string', 'max:255'],
            'tinggi_genangan' => ['required', 'integer', 'min:10', 'max:150'],
            'tanggal_kejadian' => ['required', 'date', 'before_or_equal:today'],
        ]);

        $laporan = Laporan::create($data);

        return view('hasillaporbanjir', compact('laporan'));
    }
}
