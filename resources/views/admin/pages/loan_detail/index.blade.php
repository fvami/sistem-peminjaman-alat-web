@extends('admin.layouts.app')

@section('content')
    <style>
        .loan-card {
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb !important;
        }

        .loan-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }

        .tool-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            border-radius: 10px;
            color: #64748b;
        }

        .accordion-button:not(.collapsed) {
            background-color: #f8fafc;
            color: inherit;
        }

        .accordion-button::after {
            filter: grayscale(1);
            scale: 0.8;
        }

        .btn-group .btn-check:checked+.btn-outline-warning {
            background-color: #ffc107;
            color: #000;
            border-color: #ffc107;
        }

        .btn-group .btn-check:checked+.btn-outline-success {
            background-color: #198754;
            color: #fff;
            border-color: #198754;
        }

        .checkbox-container {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .loan-checkbox {
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
            border: 2px solid #cbd5e1;
        }
    </style>

    <div class="container py-4">
        <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1 text-dark">Riwayat Peminjaman</h4>
                <p class="text-muted small mb-0">Kelola status pengembalian dan daftar alat dalam satu tempat.</p>
            </div>
            <div class="col-12 col-md-4">
                <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="search-loan" class="form-control border-0 ps-0"
                        placeholder="Cari nama peminjam...">
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="form-check m-0">
                        <input class="form-check-input border-secondary" type="checkbox" id="selectAllLoans">
                        <label class="form-check-label small fw-bold ms-1" for="selectAllLoans">Pilih Semua</label>
                    </div>
                    <div id="bulkActions" class="d-none animate__animated animate__fadeIn">
                        <button id="exportExcel" class="btn btn-success btn-sm px-3 rounded-pill">
                            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel (<span
                                class="selectedCount">0</span>)
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <select id="filterMonth" class="form-select form-select-sm border-0 bg-light shadow-sm"
                        style="border-radius: 8px;">
                        <option value="">Semua Bulan (Tahun Ini)</option>
                        @foreach (range(1, 12) as $m)
                            <option value="{{ sprintf('%02d', $m) }}">
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="accordion border-0" id="loanAccordion">
            @forelse($loans as $loan)
                <div class="accordion-item mb-3 shadow-sm loan-card"
                    data-month="{{ \Carbon\Carbon::parse($loan->loan_date)->format('m') }}"
                    style="border-radius: 12px; overflow: hidden;">
                    <div class="accordion-header position-relative">
                        <div class="checkbox-container">
                            <input type="checkbox" class="form-check-input loan-checkbox" value="{{ $loan->id }}">
                        </div>

                        <div class="accordion-button collapsed py-3 px-4 bg-white" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $loan->id }}" style="padding-left: 55px !important;">
                            <div class="row w-100 align-items-center g-3">
                                <div class="col-12 col-md-3">
                                    <div class="fw-bold text-dark borrower-name">{{ $loan->borrower_name }}</div>
                                    <div class="text-muted small"><i
                                            class="bi bi-telephone me-1"></i>{{ $loan->borrower_phone }}</div>
                                </div>

                                <div class="col-12 col-md-4 border-start-md">
                                    <div class="d-flex justify-content-between justify-content-md-around text-md-center">
                                        <div>
                                            <small class="text-muted d-block mb-1" style="font-size: 0.65rem;">TGL
                                                PINJAM</small>
                                            <span
                                                class="small fw-semibold">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</span>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block mb-1" style="font-size: 0.65rem;">EST.
                                                KEMBALI</small>
                                            @php $isOverdue = \Carbon\Carbon::parse($loan->return_plan)->isPast() && $loan->status == 'borrowed'; @endphp
                                            <span
                                                class="small fw-semibold {{ $isOverdue ? 'text-danger animate__animated animate__flash animate__infinite' : 'text-primary' }}">
                                                {{ \Carbon\Carbon::parse($loan->return_plan)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5">
                                    <div
                                        class="d-flex align-items-center justify-content-between justify-content-md-end gap-1 gap-md-2 me-md-3">

                                        <form action="{{ route('loans.update-global-status', $loan->id) }}" method="POST"
                                            class="d-flex align-items-center form-update-status flex-grow-1 flex-md-grow-0"
                                            onclick="event.stopPropagation();">
                                            @csrf

                                            <div
                                                class="btn-group btn-group-sm shadow-sm me-2 border rounded-pill overflow-hidden flex-grow-1 flex-md-grow-0">
                                                <input type="radio" class="btn-check" name="status"
                                                    id="b{{ $loan->id }}" value="borrowed"
                                                    {{ $loan->status == 'borrowed' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-warning border-0 px-2 px-md-3 fw-bold"
                                                    for="b{{ $loan->id }}" style="font-size: 0.7rem;">BORROWED</label>

                                                <input type="radio" class="btn-check" name="status"
                                                    id="r{{ $loan->id }}" value="returned"
                                                    {{ $loan->status == 'returned' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-success border-0 px-2 px-md-3 fw-bold"
                                                    for="r{{ $loan->id }}" style="font-size: 0.7rem;">RETURNED</label>
                                            </div>

                                            <button type="submit"
                                                class="btn btn-dark btn-sm px-2 px-md-3 rounded-pill shadow-sm fw-bold"
                                                style="font-size: 0.75rem;">Update</button>
                                        </form>

                                        @can('administrator')
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm rounded-circle delete-loan-btn d-flex align-items-center justify-content-center"
                                                onclick="event.stopPropagation();" data-id="{{ $loan->id }}"
                                                data-name="{{ $loan->borrower_name }}"
                                                style="width: 30px; height: 30px; min-width: 30px;">
                                                <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="collapse{{ $loan->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#loanAccordion">
                        <div class="accordion-body bg-light-subtle p-0 border-top">
                            <div class="p-3 p-md-4">
                                <div class="table-responsive d-none d-md-block">
                                    <table class="table table-hover align-middle mb-0 bg-white rounded shadow-sm">
                                        <thead class="bg-light">
                                            <tr class="text-muted small text-uppercase">
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
                                                            <div class="tool-icon me-3"><i class="bi bi-box-seam"></i>
                                                            </div>
                                                            <span class="fw-semibold small">{{ $item->tool->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td><span
                                                            class="badge bg-secondary-subtle text-secondary fw-normal">{{ $item->tool->category->name ?? '-' }}</span>
                                                    </td>
                                                    <td class="text-center"><span
                                                            class="badge bg-light text-dark border px-3">{{ $item->qty }}</span>
                                                    </td>
                                                    <td class="pe-4 text-end"><small
                                                            class="text-muted font-monospace">#{{ $item->tool_id }}</small>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-md-none">
                                    @foreach ($loan->details as $item)
                                        <div class="card border-0 shadow-sm mb-2" style="border-radius: 10px;">
                                            <div class="card-body p-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="tool-icon me-2"><i class="bi bi-box-seam"></i></div>
                                                        <div>
                                                            <div class="fw-bold small">{{ $item->tool->name }}</div>
                                                            <div class="text-muted small" style="font-size: 0.7rem;">
                                                                {{ $item->tool->category->name ?? '-' }}</div>
                                                        </div>
                                                    </div>
                                                    <span class="badge bg-dark rounded-pill">{{ $item->qty }}
                                                        Unit</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="p-3 bg-white border-top">
                                <div class="d-flex align-items-start text-muted">
                                    <i class="bi bi-geo-alt-fill text-danger me-2 mt-1"></i>
                                    <div style="font-size: 0.85rem;">
                                        <span class="fw-bold d-block text-dark small mb-1">Alamat Peminjam:</span>
                                        {{ $loan->borrower_address ?: 'Tidak ada alamat tersedia.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-4 shadow-sm border">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <p class="mt-2 text-muted">Data peminjaman tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
    @push('js')
        @include('admin.pages.loan_detail.js')
    @endpush
@endsection
