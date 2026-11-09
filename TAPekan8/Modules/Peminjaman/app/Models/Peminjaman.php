<?php

namespace Modules\Peminjaman\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = [
        'nama_peminjam',
        'judul_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'bukti_path',
        'nama_bukti',
    ];

    protected $appends = ['bukti_url'];

    protected function buktiUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->bukti_path
            ? asset('storage/' . $this->bukti_path)
            : null);
    }
}
