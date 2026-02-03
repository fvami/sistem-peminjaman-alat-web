@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap g-3">
            <div>
                <h4 class="fw-bold mb-1">Riwayat Peminjaman</h4>
                <p class="text-muted small mb-0">Kelola status pengembalian dan daftar alat dalam satu tempat.</p>
            </div>
            <div class="col-md-4">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="search-loan" class="form-control border-0 ps-0"
                        placeholder="Cari nama peminjam...">
                </div>
            </div>
        </div>

        <div class="accordion border-0" id="loanAccordion">
            @forelse($loans as $loan)
                <div class="accordion-item mb-3 border shadow-sm loan-card" style="border-radius: 12px; overflow: hidden;">
                    <div class="accordion-header">
                        <div class="accordion-button collapsed py-3 px-4 bg-white" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $loan->id }}">
                            <div class="row w-100 align-items-center g-3">
                                <div class="col-12 col-md-3">
                                    <div class="fw-bold text-dark borrower-name" style="font-size: 1rem;">
                                        {{ $loan->borrower_name }}</div>
                                    <div class="text-muted small"><i class="bi bi-telephone me-1"></i>
                                        {{ $loan->borrower_phone }}</div>
                                </div>

                                <div class="col-12 col-md-4 pt-2 pt-md-0">
                                    <div class="d-flex justify-content-between justify-content-md-around text-md-center">
                                        <div>
                                            <small class="text-muted d-block small-label mb-1">PINJAM</small>
                                            <span
                                                class="small fw-semibold text-dark">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</span>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block small-label mb-1">EST. KEMBALI</small>
                                            <span
                                                class="small fw-semibold text-danger">{{ \Carbon\Carbon::parse($loan->return_plan)->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 pt-2 pt-md-0">
                                    <form action="{{ route('loans.update-global-status', $loan->id) }}" method="POST"
                                        class="d-flex align-items-center justify-content-between justify-content-md-end m-0 form-update-status me-md-5"
                                        onclick="event.stopPropagation();">
                                        @csrf
                                        <div class="btn-group btn-group-sm shadow-sm me-2"
                                            style="border-radius: 8px; overflow: hidden;">
                                            <input type="radio" class="btn-check" name="status" id="b{{ $loan->id }}"
                                                value="borrowed" {{ $loan->status == 'borrowed' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-warning border-0 fw-bold px-3"
                                                for="b{{ $loan->id }}">BORROWED</label>

                                            <input type="radio" class="btn-check" name="status" id="r{{ $loan->id }}"
                                                value="returned" {{ $loan->status == 'returned' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success border-0 fw-bold px-3"
                                                for="r{{ $loan->id }}">RETURNED</label>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-sm px-4 rounded-pill shadow-sm me-2">
                                            Update
                                        </button>
                                        @can('administrator')
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm px-2 rounded-circle delete-loan-btn"
                                                data-id="{{ $loan->id }}" data-name="{{ $loan->borrower_name }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="collapse{{ $loan->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body bg-light-subtle p-0 border-top">
                            <div class="p-3 p-md-4">
                                <div class="table-responsive d-none d-md-block">
                                    <table
                                        class="table table-hover align-middle mb-0 shadow-sm bg-white rounded overflow-hidden">
                                        <thead class="bg-light">
                                            <tr class="text-muted small uppercase">
                                                <th class="ps-4 py-3">Nama Alat</th>
                                                <th>Kategori</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="pe-4 text-end">ID Alat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($loan->details as $item)
                                                <tr>
                                                    <td class="ps-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="tool-icon me-3"><i class="bi bi-box-seam"></i></div>
                                                            <span class="fw-semibold small">{{ $item->tool->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="small text-muted">{{ $item->tool->category->name ?? '-' }}</span>
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="badge bg-light text-dark border">{{ $item->qty }}</span>
                                                    </td>
                                                    <td class="pe-4 text-end"><small
                                                            class="text-muted">#{{ $item->tool_id }}</small></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-md-none">
                                    <h6 class="fw-bold mb-3 small text-muted uppercase tracking-wider">Daftar Alat:</h6>
                                    @foreach ($loan->details as $item)
                                        <div class="card border-0 shadow-sm mb-2" style="border-radius: 10px;">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <div class="tool-icon me-3"
                                                            style="width: 40px; height: 40px; background: #f1f5f9;">
                                                            <i class="bi bi-box-seam fs-5"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold small">{{ $item->tool->name }}</div>
                                                            <div class="text-muted" style="font-size: 0.7rem;">
                                                                {{ $item->tool->category->name ?? '-' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-dark rounded-pill">{{ $item->qty }}
                                                            unit</span>
                                                        <div class="text-muted mt-1" style="font-size: 0.65rem;">
                                                            #{{ $item->tool_id }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Bagian Alamat --}}
                            <div class="p-3 bg-white border-top">
                                <div class="d-flex align-items-start text-muted">
                                    <i class="bi bi-geo-alt me-2 mt-1"></i>
                                    <div style="font-size: 0.85rem;">
                                        <span class="fw-bold d-block text-dark small mb-1">Alamat
                                            Pengiriman/Peminjam:</span>
                                        {{ $loan->borrower_address ?: 'Tidak ada alamat tersedia.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-search fs-1 text-muted"></i>
                    <p class="mt-2 text-muted">Data peminjaman tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

    @push('js')
        @include('admin.pages.loan_detail.js')
    @endpush
@endsection
