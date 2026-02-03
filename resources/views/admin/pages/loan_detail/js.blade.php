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
    });
</script>
