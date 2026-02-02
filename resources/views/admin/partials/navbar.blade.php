<nav class="navbar navbar-expand navbar-light bg-white border-bottom sticky-top">
    <div class="container-fluid">
        <button class="btn btn-action-round me-3" id="menu-toggle">
            <i class="bi bi-list"></i>
        </button>
        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill-gear text-secondary"></i>
                    <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                    @if (auth()->user()->role_id === 2)
                        <div class="d-none d-md-flex align-items-center gap-2">
                            <span
                                class="badge bg-danger-subtle text-danger border border-danger-subtle fw-medium rounded-2"
                                style="font-size: 0.7rem; letter-spacing: 0.3px; padding: 3px 8px;">
                                ADMINISTARTOR
                            </span>
                        </div>
                    @else
                        <div class="d-none d-md-flex align-items-center gap-2">
                            <span
                                class="badge bg-success-subtle text-success border border-success-subtle fw-medium rounded-2"
                                style="font-size: 0.7rem; letter-spacing: 0.3px; padding: 3px 8px;">
                                OPERATOR
                            </span>
                        </div>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                    @if (auth()->user()->role_id === 2)
                        <li class="px-3 py-2 d-md-none border-bottom mb-2">
                            <span class="fw-bold">Administrator</span>
                        </li>
                    @else
                        <li class="px-3 py-2 d-md-none border-bottom mb-2">
                            <span class="fw-bold">Operator</span>
                        </li>
                    @endif
                    <li><a class="dropdown-item py-2" href="{{ url('/') }}"><i class="bi bi-house me-2"></i>
                            Beranda</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
