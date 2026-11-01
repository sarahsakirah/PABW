<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LaporanController extends Controller
{
    private const STATUS = ['Menunggu', 'Diproses', 'Selesai'];

    public function publicCreate(): View
    {
        return view('public-create');
    }

    public function publicSuccess(): View|RedirectResponse
    {
        if (! session()->pull('laporan_terkirim')) {
            return redirect()->route('lapor.create');
        }

        return view('laporan-success');
    }

    public function publicStore(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules(true));
        $data = $this->normaliseLegacyFields($data);
        $data['foto'] = $request->file('foto')->store('laporan', 'public');
        $data['status'] = 'Menunggu';
        Laporan::create($data);

        return redirect()->route('lapor.success')->with('laporan_terkirim', true);
    }

    public function index(): View
    {
        return view('laporan-index', ['laporan' => Laporan::latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('laporan-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules(true));
        $data = $this->normaliseLegacyFields($data);
        $data['foto'] = $request->file('foto')->store('laporan', 'public');
        Laporan::create($data);

        return redirect()->route('petugas.laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function show(Laporan $laporan): View
    {
        return view('laporan-show', compact('laporan'));
    }

    public function edit(Laporan $laporan): View
    {
        return view('laporan-edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan): RedirectResponse
    {
        $data = $request->validate($this->rules(false));
        $newPhoto = $request->file('foto');
        unset($data['foto']);
        $data = $this->normaliseLegacyFields($data);
        $laporan->update($data);

        if ($newPhoto) {
            $oldPhoto = $laporan->foto;
            $path = $newPhoto->store('laporan', 'public');
            $laporan->update(['foto' => $path]);
            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        }

        return redirect()->route('petugas.laporan.show', $laporan)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan): RedirectResponse
    {
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }
        $laporan->delete();

        return redirect()->route('petugas.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

    private function rules(bool $photoRequired): array
    {
        return [
            'nama_pelapor' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'lokasi' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:120'],
            'tinggi_air' => ['required', 'integer', 'min:0', 'max:1000'],
            'keterangan' => ['nullable', 'string', 'max:5000'],
            'tanggal_kejadian' => ['nullable', 'date', 'before_or_equal:today'],
            'status' => $photoRequired
                ? ['sometimes', Rule::in(self::STATUS)]
                : ['required', Rule::in(self::STATUS)],
            'foto' => $photoRequired
                ? ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
                : ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    private function normaliseLegacyFields(array $data): array
    {
        $data['tanggal_kejadian'] = $data['tanggal_kejadian'] ?? now()->toDateString();
        $data['tinggi_genangan'] = $data['tinggi_air'];

        return $data;
    }
}
