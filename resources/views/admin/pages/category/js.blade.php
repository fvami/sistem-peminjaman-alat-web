<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        init();
    });

    function init() {
        loadCategory();
        bindEvents();
    }

    function bindEvents() {
        $('#saveCategory').off('click').on('click', saveCategory);
        $('#categoryModal').on('hidden.bs.modal', resetForm);
    }

    function loadCategory() {
        $.get("{{ route('category.view') }}")
            .done(res => {
                if ($.fn.DataTable.isDataTable('#myTable')) {
                    $('#myTable').DataTable().destroy();
                }

                let html = '';
                const data = res.data ? res.data : res;

                data.forEach((v, i) => {
                    html += `
                    <tr>
                        <td data-label="No">${i + 1}</td>
                        <td data-label="Category Name"><strong>${v.name}</strong></td>
                        <td>
                            <div class="mobile-action-group d-flex gap-1 justify-content-center">
                                <button class="btn btn-outline-dark btn-sm" onclick="editCategory(${v.id})">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <button class="btn btn-dark btn-sm" onclick="deleteCategory(${v.id})">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    `;
                });

                $('#tbody').html(html);

                $('#myTable').DataTable({
                    responsive: false,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search categories..."
                    }
                });
            })
            .fail(() => showAlert('Error', 'Failed to load categories', 'error'));
    }

    function saveCategory() {
        const id = $('#category_id').val();
        const formData = new FormData($('#categoryForm')[0]);
        let url = "{{ url('/category') }}";

        if (id) {
            url += '/' + id;
            formData.append('_method', 'PUT');
        }

        $.ajax({
                url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false
            })
            .done(() => {
                closeAllModal();
                showAlert('Success', 'Category saved successfully');
                loadCategory();
            })
            .fail(err => {
                showAlert('Error', err.responseJSON?.message ?? 'Failed to save category', 'error');
            });
    }

    function editCategory(id) {
        $.get("{{ url('/category') }}/" + id)
            .done(res => {
                const d = res.data ? res.data : res;
                resetForm();
                $('#category_id').val(d.id);
                $('#name').val(d.name);
                $('#categoryModal').modal('show');
            })
            .fail(() => showAlert('Error', 'Failed to load category data', 'error'));
    }

    function deleteCategory(id) {
        Swal.fire({
            title: 'Delete this category?',
            text: "Products in this category might be affected.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#18181b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(res => {
            if (res.isConfirmed) {
                $.ajax({
                        url: "{{ url('/category') }}/" + id,
                        type: 'DELETE'
                    })
                    .done(() => {
                        showAlert('Deleted', 'Category removed successfully');
                        loadCategory();
                    })
                    .fail(() => showAlert('Error', 'Failed to delete category', 'error'));
            }
        });
    }

    function resetForm() {
        $('#categoryForm')[0].reset();
        $('#category_id').val('');
    }

    function closeAllModal() {
        $('#categoryModal').modal('hide');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css('padding-right', '0');
    }

    function showAlert(title, text = '', icon = 'success') {
        Swal.fire({
            title,
            text,
            icon,
            timer: 2000,
            showConfirmButton: false
        });
    }
</script>
