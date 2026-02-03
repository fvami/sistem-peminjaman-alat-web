<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewalat - Management Aset Terpadu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-dark: #1a1a1a;
            --accent-soft: #818181;
            --text-main: #334155;
            --bg-light: #fdfdfd;
            --transition-standard: all 0.4s ease;
        }

        body {
            font-family: "Poppins", sans-serif;
            color: var(--text-main);
            background-color: var(--bg-light);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .navbar {
            transition: all 0.3s ease-in-out;
            padding: 1.2rem 0;
            /* Padding awal saat di atas */
            background: transparent;
        }

        .navbar.scrolled {
            padding: 0.8rem 0 !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            margin-top: 2px;
        }

        #mainNav .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-main) !important;
            margin: 0 10px;
        }

        .bg-primary-subtle {
            background-color: #eef2ff !important;
            color: #747474 !important;
        }

        #userMenuBtn:hover {
            background-color: #333;
            transform: scale(1.05);
            transition: all 0.2s ease;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            padding-top: 80px;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .display-5 {
            font-weight: 700;
            letter-spacing: -1px;
            color: var(--primary-dark);
        }

        .btn-main {
            background: var(--primary-dark);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: var(--transition-standard);
            border: none;
        }

        .btn-main:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .section-padding {
            padding: 100px 0;
        }

        .feature-card {
            border: 1px solid #f1f5f9 !important;
            background: #ffffff;
            transition: var(--transition-standard);
            border-radius: 20px;
            padding: 35px;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05) !important;
            border-color: var(--accent-soft) !important;
        }

        .icon-box {
            width: 55px;
            height: 55px;
            background: #f1f5f9;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            color: var(--accent-soft);
            font-size: 1.4rem;
            transition: var(--transition-standard);
        }

        .feature-card:hover .icon-box {
            background: var(--accent-soft);
            color: white;
        }

        .cta-container {
            background: var(--primary-dark);
            border-radius: 30px;
            padding: 60px;
            color: white;
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 576px) {
            .small-mobile-text {
                font-size: 0.85rem !important;
            }

            .extra-small-text {
                font-size: 0.7rem !important;
            }

            .mt-lg-n3 {
                margin-top: 0 !important;
            }

        }

        @media (min-width: 992px) {
            .mt-lg-n3 {
                margin-top: -30px !important;
            }
        }

        @media (max-width: 991.98px) {
            .navbar {
                padding: 1.2rem 0 !important;
            }

            .navbar-brand {
                margin-top: 0;
                padding-top: 5px;
            }

            .navbar-toggler {
                margin-top: 2px;
                padding: 4px 8px;
            }

            .navbar-collapse {
                margin-top: 15px;
                background: white;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            }
        }

        .mt-n3 {
            margin-top: -20px !important;
        }

        .icon-box.shadow-sm {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .bg-primary-subtle {
            background-color: #eef2ff !important;
        }
    </style>
</head>

<body>

    @include('public.navbar')

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h6 class="text-uppercase fw-bold text-gray mb-3 small tracking-widest">General Asset Solution
                    </h6>
                    <h1 class="display-5 fw-bold mb-4">Kelola Aset Tim Lebih Cepat dan Terorganisir.</h1>
                    <p class="lead text-muted mb-5">Platform terintegrasi untuk mendata, memantau, dan mengelola
                        penggunaan alat kerja secara kolektif di mana pun lokasi operasional Anda.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-main py-3">Mulai Sekarang</a>
                        @endguest
                        <a href="#features"
                            class="btn btn-outline-dark py-3 border-2 rounded-3 fw-semibold px-4">Pelajari Fitur</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="position-relative p-5">
                        <div class="position-absolute top-50 start-50 translate-middle bg-primary-subtle rounded-circle opacity-25"
                            style="width: 400px; height: 400px; filter: blur(80px);"></div>

                        <div class="row g-4 position-relative">
                            <div class="col-6 mt-5">
                                <div class="card border-0 shadow-lg rounded-4 p-4 reveal"
                                    style="transition-delay: 0.2s;">
                                    <div class="icon-box mb-3 bg-primary text-white shadow-sm"
                                        style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Aktivitas</h6>
                                    <p class="text-muted small mb-0">Update status otomatis setiap peminjaman.</p>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card border-0 shadow-lg rounded-4 p-4 reveal"
                                    style="transition-delay: 0.4s;">
                                    <div class="icon-box mb-3 bg-success text-white shadow-sm"
                                        style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Keamanan</h6>
                                    <p class="text-muted small mb-0">Verifikasi data aset secara akurat.</p>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card border-0 shadow-lg rounded-4 p-4 reveal"
                                    style="transition-delay: 0.6s;">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-warning rounded-circle" style="width: 10px; height: 10px;"></div>
                                        <span class="ms-2 small fw-bold text-dark">Live Monitoring</span>
                                    </div>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                                    </div>
                                    <p class="text-muted small mb-0">Sistem Terintegrasi</p>
                                </div>
                            </div>

                            <div class="col-6 mt-n3">
                                <div class="card border-0 shadow-lg rounded-4 p-4 reveal"
                                    style="transition-delay: 0.8s; background: var(--primary-dark);">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-globe2 text-white opacity-75 me-2"></i>
                                        <span class="text-white-50 small fw-medium">Cloud Sync</span>
                                    </div>
                                    <h6 class="fw-bold text-white mb-2">Akses Terpusat</h6>
                                    <p class="text-white-50 mb-0" style="font-size: 0.7rem; line-height: 1.4;">
                                        Pantau dan kelola aset dari mana saja secara terintegrasi.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="section-padding reveal">
        <div class="container text-center mb-5">
            <h2 class="fw-bold">Mengapa Menggunakan Sewalat?</h2>
            <p class="text-muted">Solusi cerdas untuk efisiensi operasional harian Anda.</p>
        </div>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 border-0">
                        <div class="icon-box"><i class="bi bi-search"></i></div>
                        <h5 class="fw-semibold">Pencarian Instan</h5>
                        <p class="text-muted small">Temukan alat yang Anda butuhkan dalam hitungan detik dengan sistem
                            filter kategori yang cerdas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 border-0">
                        <div class="icon-box"><i class="bi bi-shield-check"></i></div>
                        <h5 class="fw-semibold">Kontrol Penuh</h5>
                        <p class="text-muted small">Ketahui siapa yang bertanggung jawab atas alat tertentu dan kapan
                            waktu pengembaliannya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 border-0">
                        <div class="icon-box"><i class="bi bi-lightning-charge"></i></div>
                        <h5 class="fw-semibold">Alur Efisien</h5>
                        <p class="text-muted small">Proses peminjaman dan pengembalian yang disederhanakan tanpa
                            birokrasi yang rumit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="section-padding bg-white reveal">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Prosedur Penggunaan Sewalat</h2>
                <p class="text-muted">Ikuti 3 langkah mudah untuk mulai mengelola aset Anda.</p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-lg-4">
                    <div class="p-4 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light text-dark fw-bold rounded-circle mb-4 shadow-sm"
                            style="width: 60px; height: 60px; font-size: 1.2rem;">
                            01
                        </div>
                        <h5 class="fw-bold">Registrasi & Login</h5>
                        <p class="text-muted small">Masuk ke sistem menggunakan akun yang telah terdaftar untuk
                            mengakses katalog aset tim Anda.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="p-4 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-dark text-white fw-bold rounded-circle mb-4 shadow-sm"
                            style="width: 60px; height: 60px; font-size: 1.2rem;">
                            02
                        </div>
                        <h5 class="fw-bold">Pilih & Pinjam</h5>
                        <p class="text-muted small">Cari alat yang dibutuhkan, cek ketersediaannya secara real-time,
                            dan ajukan peminjaman dalam satu klik.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="p-4 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light text-dark fw-bold rounded-circle mb-4 shadow-sm"
                            style="width: 60px; height: 60px; font-size: 1.2rem;">
                            03
                        </div>
                        <h5 class="fw-bold">Kelola & Kembalikan</h5>
                        <p class="text-muted small">Pantau masa pinjam Anda dan lakukan proses pengembalian agar aset
                            dapat digunakan oleh rekan tim lainnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-padding reveal">
        <div class="container">
            <div class="cta-container text-center">
                <h2 class="fw-bold mb-4">Mulai Transformasi Digital Aset Anda.</h2>
                <p class="mb-5 opacity-75">Gunakan sistem Sewalat untuk memastikan produktivitas tim tetap berjalan
                    maksimal tanpa kendala ketersediaan alat.</p>
                @guest
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold">Login
                            User</a>
                    </div>
                @endguest
            </div>
        </div>
    </section>

    <footer class="py-5 bg-white border-top">
        <div class="container text-center">
            <p class="fw-bold mb-1">SEWALAT.</p>
            <p class="text-muted small">Sistem Manajemen Aset Kolektif & Terpadu. © {{ date('Y') }}</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 20) {
                    $('#mainNav').addClass('scrolled');
                } else {
                    $('#mainNav').removeClass('scrolled');
                }
            });

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('active');
                    }
                });
            }, {
                threshold: 0.1
            });

            $('.reveal').each(function() {
                revealObserver.observe(this);
            });
        });
    </script>
</body>

</html>
