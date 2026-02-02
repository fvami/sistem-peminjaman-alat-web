@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-3 px-md-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <h4 class="fw-bold m-0">Akun Pengguna</h4>
                <small class="text-muted">Kelola pengguna sistem dan role.</small>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-2 p-md-3">
                <div class="table-responsive border-0">
                    <table id="myTable" class="table table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Form Pengguna</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        @csrf
                        <input type="hidden" id="user_id">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Akun</label>
                            <input name="name" id="name" class="form-control" placeholder="Masukkan nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input name="email" id="email" class="form-control" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Role</label>
                            <select name="role_id" id="role_id" class="form-select">
                                <option value="">Pilih Peran</option>
                                @foreach ($role as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="saveUser" class="btn btn-dark px-4">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        @include('admin.pages.account.js')
    @endpush
@endsection
