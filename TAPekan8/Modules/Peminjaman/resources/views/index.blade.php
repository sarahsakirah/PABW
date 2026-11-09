@extends('layouts.app')
@section('title', 'Peminjaman')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div><h1 class="h3 mb-1">Data Peminjaman</h1><p class="text-muted mb-0">Tambah, ubah, dan hapus data tanpa memuat ulang halaman.</p></div>
    <button type="button" class="btn btn-primary" id="addButton"><i class="bi bi-plus-lg me-1"></i>Tambah peminjaman</button>
</div>
<div id="alertBox" aria-live="polite"></div>
<div class="card border-0 shadow-sm"><div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>Peminjam</th><th>Judul buku</th><th>Tanggal pinjam</th><th>Tanggal kembali</th><th>Status</th><th>Bukti</th><th class="text-end">Aksi</th></tr></thead>
        <tbody id="peminjamanRows"><tr><td colspan="7" class="text-center py-5 text-muted">Memuat data...</td></tr></tbody>
    </table>
</div></div>

<div class="modal fade" id="peminjamanModal" tabindex="-1" aria-labelledby="peminjamanModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
        <div class="modal-header"><h2 class="modal-title fs-5" id="peminjamanModalTitle">Tambah Peminjaman</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button></div>
        <div class="modal-body">
            <form id="peminjamanForm" enctype="multipart/form-data">
                @csrf <input type="hidden" name="id" id="peminjamanId">
                @foreach(['nama_peminjam' => 'Nama peminjam', 'judul_buku' => 'Judul buku'] as $field => $label)
                    <div class="mb-3"><label class="form-label" for="{{ $field }}">{{ $label }}</label><input class="form-control" id="{{ $field }}" name="{{ $field }}" required><div class="invalid-feedback" id="{{ $field }}-error"></div></div>
                @endforeach
                <div class="row"><div class="col-sm-6 mb-3"><label class="form-label" for="tanggal_pinjam">Tanggal pinjam</label><input class="form-control" type="date" id="tanggal_pinjam" name="tanggal_pinjam" required><div class="invalid-feedback" id="tanggal_pinjam-error"></div></div>
                    <div class="col-sm-6 mb-3"><label class="form-label" for="tanggal_kembali">Tanggal kembali</label><input class="form-control" type="date" id="tanggal_kembali" name="tanggal_kembali"><div class="invalid-feedback" id="tanggal_kembali-error"></div></div></div>
                <div class="mb-3"><label class="form-label" for="status">Status</label><select class="form-select" id="status" name="status" required><option value="Dipinjam">Dipinjam</option><option value="Dikembalikan">Dikembalikan</option></select><div class="invalid-feedback" id="status-error"></div></div>
                <div class="mb-3"><label class="form-label" for="bukti">Bukti peminjaman <span id="buktiRequired" class="text-danger">*</span></label>
                    <div id="currentFile" class="small mb-2 d-none"></div><input class="form-control" type="file" id="bukti" name="bukti" accept=".jpg,.jpeg,.png,.pdf">
                    <div class="invalid-feedback" id="bukti-error"></div><div class="form-text">JPG, PNG, atau PDF. Maksimal 2 MB. Wajib saat menambah data.</div></div>
            </form>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-primary" id="saveButton">Simpan</button></div>
    </div></div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    const urls = {
        data: @json(route('peminjaman.data')),
        store: @json(route('peminjaman.store')),
        show: @json(route('peminjaman.show', ['peminjaman' => '__ID__'])),
        update: @json(route('peminjaman.update', ['peminjaman' => '__ID__'])),
        destroy: @json(route('peminjaman.destroy', ['peminjaman' => '__ID__']))
    };
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('peminjamanModal'));
    let records = [];

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'Accept': 'application/json'}});

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, char => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    }
    function showAlert(message, type = 'success') {
        $('#alertBox').html(`<div class="alert alert-${type} alert-dismissible fade show" role="alert">${escapeHtml(message)}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button></div>`);
    }
    function clearErrors() {
        $('#peminjamanForm .is-invalid').removeClass('is-invalid');
        $('#peminjamanForm .invalid-feedback').text('');
    }
    function renderRows() {
        if (!records.length) {
            $('#peminjamanRows').html('<tr><td colspan="7" class="text-center py-5 text-muted">Belum ada data peminjaman.</td></tr>');
            return;
        }
        $('#peminjamanRows').html(records.map(item => {
            const file = item.bukti_url
                ? `<a href="${escapeHtml(item.bukti_url)}" target="_blank" rel="noopener">${escapeHtml(item.nama_bukti || 'Lihat bukti')}</a>`
                : '<span class="text-muted">-</span>';
            const statusClass = item.status === 'Dikembalikan' ? 'text-bg-success' : 'text-bg-warning';
            return `<tr>
                <td>${escapeHtml(item.nama_peminjam)}</td><td>${escapeHtml(item.judul_buku)}</td>
                <td>${escapeHtml(item.tanggal_pinjam)}</td><td>${escapeHtml(item.tanggal_kembali || '-')}</td>
                <td><span class="badge ${statusClass}">${escapeHtml(item.status)}</span></td><td>${file}</td>
                <td class="text-end text-nowrap"><button class="btn btn-sm btn-outline-primary editButton" data-id="${item.id}">Ubah</button>
                <button class="btn btn-sm btn-outline-danger deleteButton" data-id="${item.id}" data-name="${escapeHtml(item.nama_peminjam)}">Hapus</button></td></tr>`;
        }).join(''));
    }
    function loadData() {
        $.getJSON(urls.data).done(data => { records = data; renderRows(); })
            .fail(() => showAlert('Data peminjaman gagal dimuat.', 'danger'));
    }
    function resetForm() {
        document.getElementById('peminjamanForm').reset();
        $('#peminjamanId').val(''); $('#currentFile').addClass('d-none').empty();
        $('#buktiRequired').removeClass('d-none'); clearErrors();
    }

    $('#addButton').on('click', function () { resetForm(); $('#peminjamanModalTitle').text('Tambah Peminjaman'); modal.show(); });
    $('#peminjamanModal').on('hidden.bs.modal', resetForm);
    $('#saveButton').on('click', function () {
        clearErrors();
        const id = $('#peminjamanId').val();
        const formData = new FormData(document.getElementById('peminjamanForm'));
        const url = id ? urls.update.replace('__ID__', id) : urls.store;
        if (id) formData.append('_method', 'PUT');
        $.ajax({url, method: 'POST', data: formData, processData: false, contentType: false, dataType: 'json'})
            .done(response => { modal.hide(); loadData(); showAlert(response.success); })
            .fail(xhr => {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    $.each(xhr.responseJSON.errors, (field, messages) => {
                        $('#' + field).addClass('is-invalid'); $('#' + field + '-error').text(messages[0]);
                    });
                } else showAlert('Data gagal disimpan. Coba lagi.', 'danger');
            });
    });
    $(document).on('click', '.editButton', function () {
        const id = $(this).data('id');
        $.getJSON(urls.show.replace('__ID__', id)).done(item => {
            resetForm(); $('#peminjamanModalTitle').text('Ubah Peminjaman'); $('#peminjamanId').val(item.id);
            $('#nama_peminjam').val(item.nama_peminjam); $('#judul_buku').val(item.judul_buku);
            $('#tanggal_pinjam').val(item.tanggal_pinjam); $('#tanggal_kembali').val(item.tanggal_kembali);
            $('#status').val(item.status); $('#buktiRequired').addClass('d-none');
            if (item.bukti_url) $('#currentFile').removeClass('d-none').html(`Bukti saat ini: <a href="${escapeHtml(item.bukti_url)}" target="_blank" rel="noopener">${escapeHtml(item.nama_bukti || 'Lihat bukti')}</a>`);
            modal.show();
        }).fail(() => showAlert('Data peminjaman gagal dibuka.', 'danger'));
    });
    $(document).on('click', '.deleteButton', function () {
        if (!confirm(`Hapus data peminjaman ${$(this).data('name')}?`)) return;
        $.ajax({url: urls.destroy.replace('__ID__', $(this).data('id')), method: 'DELETE', dataType: 'json'})
            .done(response => { loadData(); showAlert(response.success); })
            .fail(() => showAlert('Data peminjaman gagal dihapus.', 'danger'));
    });
    loadData();
});
</script>
@endpush
