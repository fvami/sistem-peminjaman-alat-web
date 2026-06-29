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
        loadTools();
        initSelect2();
        bindEvents();
    }

    function initSelect2() {
        $('#category_id, #status').select2({
            dropdownParent: $('#toolModal'),
            width: '100%'
        });
        $('#toolModal').on('shown.bs.modal', function() {
            $('#category_id, #status').select2({
                dropdownParent: $('#toolModal'),
                width: '100%'
            });
        });
    }

    function bindEvents() {
        $('#saveTool').off('click').on('click', saveTool);
        $('#image').on('change', previewImage);
        $('#reset-image').on('click', resetImage);
        $('#toolModal').on('hidden.bs.modal', resetForm);
    }

    function loadTools() {
        $.get("/tool")
            .done(res => {

                if ($.fn.DataTable.isDataTable('#myTable')) $('#myTable').DataTable().destroy();
                let html = '';
                res.data.forEach((v, i) => {
                    html += `<tr>
<td data-label="No">${i+1}</td>
<td data-label="Tool"><strong>${v.name}</strong></td>
<td data-label="Category"><span class="badge bg-light text-dark border">${v.category}</span></td>
<td data-label="Stock">${v.stock} pcs</td>
<td data-label="Status">
<span class="badge ${v.status==='available'?'bg-success':(v.status==='unavailable'?'bg-danger':'bg-warning')}">
${v.status.charAt(0).toUpperCase()+v.status.slice(1)}
</span></td>
<td data-label="Image">
<img src="${v.image_url ?? '/default-image.png'}" width="50" height="50"
     class="rounded shadow-sm cursor-pointer object-fit-cover"
     onclick="showImage('${v.image_url ?? '/default-image.png'}')">
</td>
<td>
<div class="d-flex gap-1 justify-content-center">
<button class="btn btn-outline-dark btn-sm" onclick="editTool(${v.id})"><i class="bi bi-pencil"></i> Edit</button>
<button class="btn btn-dark btn-sm" onclick="deleteTool(${v.id})"><i class="bi bi-trash"></i> Delete</button>
</div>
</td>
</tr>`;
                });
                $('#tbody').html(html);
                $('#myTable').DataTable({
                    responsive: false,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search tools..."
                    }
                });
            })
            .fail(() => showAlert('Error', 'Failed load data', 'error'));
    }


    function saveTool() {
        const id = $('#tool_id').val();
        const formData = new FormData($('#toolForm')[0]);
        let url = id ? `/tool/${id}` : "/tool";
        if (id) formData.append('_method', 'PUT');
        $.ajax({
            url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        }).done(() => {
            closeAllModal();
            showAlert('Success', 'Tool saved successfully');
            loadTools();
        }).fail(err => {
            const msg = err.responseJSON?.message || 'Failed save tool';
            showAlert('Error', msg, 'error');
        });
    }


    function editTool(id) {
        $.get(`/tool/${id}`)
            .done(res => {
                const d = res.data;
                resetForm();
                $('#tool_id').val(d.id);
                $('#name').val(d.name);
                $('#description').val(d.description ?? '');
                $('#stock').val(d.stock ?? 0);
                $('#category_id').val(d.category_id).trigger('change');
                $('#status').val(d.status).trigger('change');
                if (d.image_url) showPreview(d.image_url);
                $('#toolModal').modal('show');
            })
            .fail(() => showAlert('Error', 'Failed load tool', 'error'));
    }


    function deleteTool(id) {
        Swal.fire({
            title: 'Delete this tool?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#18181b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(res => {
            if (res.isConfirmed) {
                $.ajax({
                        url: `/tool/${id}`,
                        type: 'DELETE'
                    })
                    .done(() => {
                        showAlert('Deleted', 'Tool removed');
                        loadTools();
                    })
                    .fail(() => showAlert('Error', 'Failed delete', 'error'));
            }
        });
    }

    function previewImage() {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => showPreview(e.target.result);
        reader.readAsDataURL(file);
    }

    function showPreview(src) {
        $('#preview').attr('src', src).removeClass('d-none');
        $('#placeholder-content').addClass('d-none');
        $('#reset-image').removeClass('d-none');
        $('#dropzone').css({
            borderStyle: 'solid'
        });
        $('#remove_image').val(0);
    }

    function resetImage() {
        $('#image').val('');
        $('#preview').addClass('d-none').attr('src', '');
        $('#placeholder-content').removeClass('d-none');
        $('#reset-image').addClass('d-none');
        $('#dropzone').css({
            borderStyle: 'dashed'
        });
        if ($('#tool_id').val()) $('#remove_image').val(1);
        else $('#remove_image').val(0);
    }

    function resetForm() {
        $('#toolForm')[0].reset();
        $('#tool_id').val('');
        resetImage();
        $('#category_id').val(null).trigger('change');
        $('#status').val('available').trigger('change');
        $('#remove_image').val(0);
    }

    function closeAllModal() {
        $('.modal').modal('hide');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css('padding-right', '0');
    }

    function showImage(src) {
        $('#fullImage').attr('src', src);
        $('#imageModal').modal('show');
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
