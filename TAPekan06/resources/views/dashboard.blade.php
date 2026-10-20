<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard LaporBanjir
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Laporan Banjir Kabupaten Bandung</h3>
                    <p class="mt-1 text-sm text-gray-600">Selamat datang, {{ auth()->user()->name }}.</p>
                </div>
                <a href="{{ route('laporan.create') }}" class="inline-flex items-center rounded-md bg-sky-700 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-800">Buat laporan</a>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">Daftar laporan</h3>
                @forelse ($laporan as $item)
                    @php
                        $status = $item->tinggi_genangan < 50 ? 'Waspada' : ($item->tinggi_genangan < 100 ? 'Siaga' : 'Awas');
                        $warna = ['Waspada' => 'text-green-700', 'Siaga' => 'text-amber-700', 'Awas' => 'text-red-700'][$status];
                    @endphp
                    <article class="mb-3 rounded-lg border border-gray-200 p-4 last:mb-0">
                        <p class="font-semibold text-gray-900">{{ $item->nama_pelapor }} <span class="font-normal text-gray-600">— {{ $item->lokasi }}</span></p>
                        <p class="mt-1 text-sm text-gray-600">Tinggi genangan {{ $item->tinggi_genangan }} cm · {{ $item->tanggal_kejadian->format('d-m-Y') }}</p>
                        <p class="mt-1 text-sm font-semibold {{ $warna }}">Status: {{ $status }}</p>
                    </article>
                @empty
                    <p class="text-gray-600">Belum ada laporan. Silakan buat laporan pertama.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
