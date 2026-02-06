<nav class="navbar navbar-expand-lg fixed-top navbar-light" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#">SIPELAT.</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <i class="bi bi-grid-fill fs-3"></i>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Keunggulan</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Prosedur</a></li>
            </ul>

            <div class="d-flex align-items-center mt-3 mt-lg-0">
                @auth
                    <div class="d-flex align-items-center bg-white border rounded-pill py-1 ps-3 pe-2 shadow-sm">
                        <div class="me-3 d-flex align-items-center">
                            <span class="fw-semibold text-dark small me-2">{{ Auth::user()->name }}</span>
                            <span class="badge bg-primary-subtle text-primary fw-bold"
                                style="font-size: 0.6rem; letter-spacing: 0.5px; border-radius: 4px; padding: 3px 6px;">
                                {{ Auth::user()->role->name ?? 'User' }}
                            </span>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-dark rounded-circle d-flex align-items-center justify-content-center p-0"
                                type="button" id="userMenuBtn" data-bs-toggle="dropdown" aria-expanded="false"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-2 mt-3 rounded-4">
                                @if (auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2 fw-semibold small"
                                            href="{{ route('dashboard.view') }}">
                                            <i class="bi bi-grid-1x2 me-2"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item text-danger rounded-3 py-2 fw-semibold small">
                                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="d-flex align-items-center gap-4">
                        <span class="text-muted small fw-medium d-none d-md-block">Selamat Datang</span>
                        <a href="{{ route('login') }}" class="btn btn-main btn-sm rounded-pill px-4 fw-bold">Masuk
                            Sistem</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
