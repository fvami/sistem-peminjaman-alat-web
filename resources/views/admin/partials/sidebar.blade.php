<aside id="sidebar-wrapper">
    <div class="sidebar-heading">
        <div class="brand-box">
            <i class="bi bi-cart-fill"></i>
            @if (auth()->user()->role_id === 1)
                <span>Operator Sewalat.</span>
            @else
                <span>Admin Sewalat.</span>
            @endif
        </div>
        <button type="button" class="btn border-0 p-0 d-md-none text-dark" id="close-sidebar" style="line-height: 1;">
            <i class="bi bi-x-lg fs-4"></i>
        </button>
    </div>

    <div class="list-group list-group-flush">

        {{-- -------------------------------------- --}}
        <div class="menu-label"></div>
        {{-- -------------------------------------- --}}

        <a href="{{ route('dashboard.view') }}"
            class="list-group-item {{ request()->routeIs('dashboard.view') ? 'active-link' : '' }}">
            <i class="bi bi-grid-1x2"></i> <span>Dashboard</span>
        </a>

        @can('administrator')
            <a href="{{ route('admin.tool') }}"
                class="list-group-item {{ request()->routeIs('admin.tool') ? 'active-link' : '' }}">
                <i class="bi bi-box-seam"></i> <span>Daftar Alat</span>
            </a>

            <a href="{{ route('admin.category') }}"
                class="list-group-item {{ request()->routeIs('admin.category') ? 'active-link' : '' }}">
                <i class="bi bi-collection"></i> <span>Kategori Alat</span>
            </a>

            <a href="{{ route('user.view') }}"
                class="list-group-item {{ request()->routeIs('user.view') ? 'active-link' : '' }}">
                <i class="bi bi-person-fill-lock"></i> <span>Kelola Akun</span>
            </a>
        @endcan

        @can('operator')
            <a href="{{ route('operator.loan') }}"
                class="list-group-item {{ request()->routeIs('operator.loan') ? 'active-link' : '' }}">
                <i class="bi bi-plus-circle-fill"></i> <span>Peminjaman</span>
            </a>
        @endcan

        <a href="{{ route('loans.detail') }}"
            class="list-group-item {{ request()->routeIs('loans.detail') ? 'active-link' : '' }}">
            <i class="bi bi-card-list"></i> <span>Daftar Pinjaman</span>
        </a>



    </div>
    <div class="sidebar-footer">
        <small>© 2026 fvM</small>
    </div>
</aside>
