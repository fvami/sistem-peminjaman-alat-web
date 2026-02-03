<script>
    $(document).ready(function() {
        $("#search-loan").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".loan-card").filter(function() {
                $(this).toggle($(this).find('.borrower-name').text().toLowerCase().indexOf(
                    value) > -1)
            });
        });

        $('.form-update-status').on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let selectedStatus = $(form).find('input[name="status"]:checked').val();

            if (selectedStatus === 'returned') {
                Swal.fire({
                    title: 'Konfirmasi Pengembalian',
                    text: "Apakah Anda yakin semua alat sudah kembali dalam kondisi baik? Stok akan otomatis bertambah.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#18181b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Sudah Kembali!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoadingAndSubmit(form);
                    }
                });
            } else {
                showLoadingAndSubmit(form);
            }
        });

        function showLoadingAndSubmit(form) {
            Swal.fire({
                title: 'Memproses...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: $(form).serialize(),
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data telah diperbarui.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }
        $('.delete-loan-btn').on('click', function(e) {
            e.preventDefault();
            let loanId = $(this).data('id');
            let name = $(this).data('name');

            Swal.fire({
                title: 'Hapus Data?',
                text: `Hapus peminjaman atas nama "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: `/loans-detail-view/${loanId}`,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            let card = $(`button[data-id="${loanId}"]`).closest(
                                '.loan-card');

                            card.slideUp(400, function() {
                                $(this)
                                    .remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: `Data "${name}" berhasil dihapus.`,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            });
                        }
                    });
                }
            });
        });
        $('#exportExcel').on('click', function() {
            let ids = $('.loan-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (ids.length > 0) {
                let url = '/loans/export-excel';
                window.location.href = `${url}?ids=${ids.join(',')}`;
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Data',
                    text: 'Silakan pilih minimal satu data untuk di-export ke Excel.'
                });
            }
        });

        function refreshBulkUI() {
            let selectedCount = $('.loan-checkbox:checked').length;
            $('.selectedCount').text(selectedCount);

            if (selectedCount > 0) {
                $('#bulkActions').removeClass('d-none').addClass('d-flex');
            } else {
                $('#bulkActions').addClass('d-none').removeClass('d-flex');
            }
        }

        $('#filterMonth').on('change', function() {
            let month = $(this).val();
            $('.loan-checkbox, #selectAllLoans').prop('checked', false);

            $(".loan-card").each(function() {
                if (month === "") {
                    $(this).show();
                } else {
                    $(this).data('month') == month ? $(this).show() : $(this).hide();
                }
            });
            refreshBulkUI();
        });

        $('#selectAllLoans').on('change', function() {
            let isChecked = $(this).prop('checked');
            $('.loan-card:visible .loan-checkbox').prop('checked', isChecked);
            refreshBulkUI();
        });

        $(document).on('change', '.loan-checkbox', function() {
            let allVisible = $('.loan-card:visible .loan-checkbox').length;
            let allChecked = $('.loan-card:visible .loan-checkbox:checked').length;
            $('#selectAllLoans').prop('checked', allVisible === allChecked && allVisible > 0);
            refreshBulkUI();
        });
    });
</script>
