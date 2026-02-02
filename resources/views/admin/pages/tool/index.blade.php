@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-3 px-md-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <h4 class="fw-bold m-0">Inventaris Alat</h4>
                <small class="text-muted">Pengelolaan alat anda.</small>
            </div>
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#toolModal">
                <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Alat Baru</span>
            </button>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-2 p-md-3">
                <div class="table-responsive border-0">
                    <table id="myTable" class="table table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="toolModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Alat</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="toolForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="tool_id">
                        <input type="hidden" name="remove_image" id="remove_image" value="0">

                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="form-label">Nama Alat</label>
                                <input name="name" id="name" class="form-control">

                                <div class="mt-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label class="form-label">Stok</label>
                                        <input name="stock" id="stock" type="number" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="available">Available</option>
                                            <option value="unavailable">Unavailable</option>
                                            <option value="maintenance">Maintenance</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-5 position-relative">
                                <label class="form-label small fw-bold text-dark">Gambar Alat</label>
                                <div id="dropzone"
                                    class="p-4 bg-light rounded-4 text-center d-flex flex-column align-items-center justify-content-center border"
                                    style="border: 2px dashed #dee2e6 !important; min-height: 215px; overflow: hidden;">
                                    <div id="placeholder-content">
                                        <div class="bg-white p-3 rounded-circle shadow-sm mb-3 d-inline-block">
                                            <i class="bi bi-cloud-arrow-up text-primary fs-3"></i>
                                        </div>
                                        <p class="mb-1 fw-bold small text-dark">Klik atau tarik</p>
                                    </div>
                                    <img id="preview" class="img-fluid rounded-3 d-none shadow-sm"
                                        style="max-height: 180px; object-fit: contain;">
                                    <input type="file" name="image" id="image"
                                        class="position-absolute opacity-0 w-100 h-100 start-0 top-0"
                                        style="cursor: pointer;">
                                </div>
                                <button type="button" id="reset-image"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 d-none">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button id="saveTool" class="btn btn-dark">Simpan</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 bg-transparent">
                <div class="text-end mb-2">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <img id="fullImage" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>

    @push('js')
        @include('admin.pages.tool.js')
    @endpush
@endsection
