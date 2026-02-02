@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <form id="loanForm" method="POST" action="{{ route('loans.store') }}">
            @csrf
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-7 border-end border-light">
                            <h5 class="fw-bold mb-4"><i class="bi bi-person-lines-fill me-2"></i>Data Peminjam</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Lengkap</label>
                                    <input type="text" name="borrower_name" class="form-control bg-light border-0"
                                        placeholder="Contoh: Leonardo" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nomor HP</label>
                                    <input type="text" name="borrower_phone" class="form-control bg-light border-0"
                                        placeholder="0812..." required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Alamat</label>
                                    <textarea name="borrower_address" class="form-control bg-light border-0" rows="2"
                                        placeholder="Alamat lengkap lokasi penggunaan..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Tanggal Pinjam</label>
                                    <input type="date" name="loan_date" class="form-control bg-light border-0" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Rencana Kembali</label>
                                    <input type="date" name="return_plan" class="form-control bg-light border-0"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 ps-lg-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold m-0"><i class="bi bi-cart3 me-2"></i>Item Peminjaman</h5>
                                <button type="submit" class="btn btn-dark btn-sm px-4">Simpan Transaksi</button>
                            </div>

                            <div style="max-height: 250px; overflow-y: auto;">
                                <ul class="list-group list-group-flush" id="cart-list">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <h4 class="fw-bold m-0">Pilih Alat</h4>
            </div>
            <div class="col-md-6">
                <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="search-tool" class="form-control border-0 ps-0 py-2"
                        placeholder="Cari nama alat atau kategori...">
                </div>
            </div>
        </div>

        <div class="row g-3" id="tool-container">
            @include('admin.pages.loan.tool_cards', ['tools' => $tools])
        </div>
    </div>
@endsection

@push('js')
    @include('admin.pages.loan.js');
@endpush
