@foreach ($tools as $tool)
    <div class="col-md-4 col-lg-3 tool-item">
        <div class="card h-100 border-0 shadow-sm tool-card" style="border-radius: 12px;">
            <div class="position-relative">
                <img src="{{ $tool->image ? asset('storage/' . $tool->image) : 'https://placehold.co/400x300?text=No+Image' }}"
                    class="card-img-top object-fit-cover" style="height: 140px; border-radius: 12px 12px 0 0;">
                <span class="badge bg-white text-dark position-absolute bottom-0 end-0 m-2 shadow-sm">
                    Stok: {{ $tool->stock }}
                </span>
            </div>
            <div class="card-body p-3">
                <p class="text-muted small mb-1">{{ optional($tool->category)->name }}</p>
                <h6 class="fw-bold mb-3">{{ $tool->name }}</h6>
                <button type="button" class="btn btn-outline-dark btn-sm w-100 add-cart" data-id="{{ $tool->id }}">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
            </div>
        </div>
    </div>
@endforeach
