<?php

namespace Modules\Peminjaman\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $peminjaman = $this->route('peminjaman');

        return [
            'nama_peminjam' => ['required', 'string', 'max:255'],
            'judul_buku' => ['required', 'string', 'max:255'],
            'tanggal_pinjam' => ['required', 'date'],
            'tanggal_kembali' => ['nullable', 'date', 'after_or_equal:tanggal_pinjam'],
            'status' => ['required', Rule::in(['Dipinjam', 'Dikembalikan'])],
            'bukti' => [
                $peminjaman ? 'nullable' : 'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
            'bukti.required' => 'Bukti peminjaman wajib diunggah.',
            'bukti.mimes' => 'Bukti harus berformat JPG, PNG, atau PDF.',
            'bukti.max' => 'Ukuran bukti maksimal 2 MB.',
        ];
    }
}
