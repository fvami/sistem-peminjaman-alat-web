@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-3 px-md-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <h4 class="fw-bold m-0">Kategori Alat</h4>
                <small class="text-muted">Atur barang toko Anda berdasarkan kategori.</small>
            </div>
            <button class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#categoryModal">
                <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Kategori Baru</span>
            </button>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-2 p-md-3">
                <div class="table-responsive border-0">
                    <table id="myTable" class="table table-hover align-middle w-100">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Kategori</th>
                                <th class="text-center" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Form Kategori</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        @csrf
                        <input type="hidden" id="category_id">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input name="name" id="name" class="form-control" placeholder="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button id="saveCategory" class="btn btn-dark px-4">Simpan Kategori</button>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        @include('admin.pages.category.js')
    @endpush
@endsection
