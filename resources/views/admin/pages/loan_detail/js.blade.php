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
            form.submit();
        }
    });
</script>
