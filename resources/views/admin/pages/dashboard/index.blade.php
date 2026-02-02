@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="mb-4">
            <h4 class="fw-bold mb-1 text-dark">Overview Dashboard</h4>
            <p class="text-muted small">Pantau statistik alat dan aktivitas peminjaman secara real-time.</p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm p-3 card-stat h-100">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape bg-primary-subtle text-primary rounded-4 me-3">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block fw-bold tracking-wider uppercase">TOTAL ALAT</small>
                            <h3 class="fw-bold mb-0 text-dark counter">{{ $totalTools }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm p-3 card-stat h-100">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape bg-info-subtle text-info rounded-4 me-3">
                            <i class="bi bi-tags fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block fw-bold tracking-wider uppercase">KATEGORI</small>
                            <h3 class="fw-bold mb-0 text-dark counter">{{ $totalCategories }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm p-3 card-stat h-100 border-bottom border-warning border-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape bg-warning-subtle text-warning rounded-4 me-3">
                            <i class="bi bi-arrow-left-right fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block fw-bold tracking-wider uppercase">SEDANG DIPINJAM</small>
                            <h3 class="fw-bold mb-0 text-dark counter">{{ $activeLoans }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-7">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-dark">Alat Paling Sering Dipinjam</h6>
                        <span class="badge bg-primary-subtle text-primary rounded-pill small px-3">Top 5</span>
                    </div>
                    <div class="card-body px-4 pb-4">
                        @forelse ($topTools as $top)
                            @php
                                $maxBorrowed = $topTools->max('total_borrowed') ?: 1;
                                $percentage = ($top->total_borrowed / $maxBorrowed) * 100;
                            @endphp
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="small fw-bold text-secondary">{{ $top->tool->name }}</span>
                                    <span class="small badge bg-light text-dark border">{{ $top->total_borrowed }}x
                                        Dipinjam</span>
                                </div>
                                <div class="progress bg-light" style="height: 10px; border-radius: 20px;">
                                    <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                                        data-width="{{ $percentage }}%"
                                        style="width: 0%; transition: width 1.5s ease-in-out;">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-bar-chart text-muted fs-1"></i>
                                <p class="text-muted small mt-2">Belum ada data peminjaman.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h6 class="fw-bold mb-0 text-dark">Aktivitas Terbaru</h6>
                    </div>
                    <div class="card-body px-4">
                        <div class="timeline">
                            @forelse ($recentLoans as $loan)
                                <div class="d-flex mb-4 position-relative">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle {{ $loan->status == 'returned' ? 'bg-success' : 'bg-warning' }} d-flex align-items-center justify-content-center shadow-sm"
                                            style="width: 35px; height: 35px;">
                                            <i
                                                class="bi {{ $loan->status == 'returned' ? 'bi-check-lg' : 'bi-clock' }} text-white fs-6"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3 w-100 border-bottom pb-2">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <p class="small mb-0 fw-bold text-dark">{{ Str::title($loan->borrower_name) }}
                                            </p>
                                            <small class="text-muted mt-1"
                                                style="font-size: 0.65rem;">{{ $loan->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="text-muted mb-0" style="font-size: 0.75rem;">
                                            Meminjam <span
                                                class="fw-bold text-primary">{{ $loan->details->count() }}</span> alat
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    <p class="small">Tidak ada aktivitas terbaru.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .icon-shape {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-stat {
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .card-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
        }

        .tracking-wider {
            letter-spacing: 0.5px;
            font-size: 0.6rem;
        }

        .bg-primary-subtle {
            background-color: #eef2ff !important;
        }

        .bg-info-subtle {
            background-color: #ecfeff !important;
        }

        .bg-warning-subtle {
            background-color: #fffbeb !important;
        }

        .timeline .d-flex:last-child .ms-3 {
            border-bottom: none !important;
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            h3 {
                font-size: 1.5rem;
            }

            .icon-shape {
                width: 45px;
                height: 45px;
            }
        }
    </style>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.counter').each(function() {
                    var $this = $(this);
                    var countTo = $this.text();
                    $({
                        countNum: 0
                    }).animate({
                        countNum: countTo
                    }, {
                        duration: 1500,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    });
                });
                
                setTimeout(function() {
                    $('.progress-bar').each(function() {
                        var targetWidth = $(this).data('width');
                        $(this).css('width', targetWidth);
                    });
                }, 300);
            });
        </script>
    @endpush
@endsection
