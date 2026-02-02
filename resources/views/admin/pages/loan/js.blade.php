<script>
    $(document).ready(function() {

        $('#loanForm').on('submit', function(e) {
            e.preventDefault();

            if ($('#cart-list li.text-muted').length > 0 || $('#cart-list li').length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Keranjang Kosong',
                    text: 'Silakan pilih minimal satu alat terlebih dahulu!',
                    confirmButtonColor: '#18181b',
                });
                return;
            }

            Swal.fire({
                title: 'Simpan Peminjaman?',
                text: "Pastikan data peminjam dan daftar alat sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#18181b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    this.submit();
                }
            });
        });
        $('#search-tool').on('keyup', function() {
            let value = $(this).val().toLowerCase();
            $(".tool-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        function renderCart(cart) {
            let html = '';
            if (Object.keys(cart).length === 0) {
                html = '<li class="text-center py-4 text-muted small">Keranjang kosong</li>';
            } else {
                $.each(cart, function(i, item) {
                    html += `
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-light">
                    <div style="flex: 1;">
                        <div class="fw-bold small mb-1">${item.name}</div>
                        <div class="d-flex align-items-center">
                            <input type="number" class="form-control form-control-sm update-qty me-2" 
                                data-id="${item.tool_id}" value="${item.qty}" min="1" style="width: 60px; height: 25px; font-size: 12px;">
                            <small class="text-muted">Unit</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-link text-danger remove-cart p-0" data-id="${item.tool_id}">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </li>`;
                });
            }
            $('#cart-list').html(html);
        }

        $(document).on('click', '.add-cart', function() {
            updateCart('add', $(this).data('id'));
        });

        $(document).on('click', '.remove-cart', function() {
            updateCart('remove', $(this).data('id'));
        });

        $(document).on('change', '.update-qty', function() {
            let qty = $(this).val();
            updateCart('update', $(this).data('id'), qty);
        });

        function updateCart(action, tool_id, qty = 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            $.post('{{ route('loans.cart') }}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                action: action,
                tool_id: tool_id,
                qty: qty
            }, function(cart) {
                renderCart(cart);
                let title = "Berhasil!";
                if (action === 'add') title = "Alat ditambahkan";
                if (action === 'remove') title = "Alat dihapus";
                if (action === 'update') title = "Jumlah diperbarui";

                Toast.fire({
                    icon: 'success',
                    title: title
                });

            }).fail(function(xhr) {
                let errorMsg = "Terjadi kesalahan sistem.";
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = xhr.responseJSON.error;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMsg,
                    confirmButtonColor: '#18181b',
                }).then(() => {
                    $.get('{{ route('loans.cart') }}', function(currentCart) {
                        renderCart(currentCart);
                    });
                });
            });
        }
        renderCart(@json($cart));
    });
</script>
