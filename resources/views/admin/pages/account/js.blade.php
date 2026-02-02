-- Active: 1765372619065@@127.0.0.1@3306@sewalat
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
        loadUsers();
        initSelect2();
        bindEvents();
    }

    function initSelect2() {
        $('#role_id').select2({
            dropdownParent: $('#userModal'),
            width: '100%'
        });
    }

    function bindEvents() {
        $('#saveUser').off('click').on('click', saveUser);
        $('#userModal').on('hidden.bs.modal', resetForm);
    }

    function loadUsers() {
        $.get("/user")
            .done(res => {

                if ($.fn.DataTable.isDataTable('#myTable')) $('#myTable').DataTable().destroy();

                let html = '';
                const users = res.data;

                users.forEach((v, i) => {
                    html += `<tr>
<td data-label="No">${i + 1}</td>
<td data-label="Nama"><strong>${v.name}</strong></td>
<td data-label="Email">${v.email}</td>
<td data-label="Role"><span class="badge bg-light text-dark border">${v.role || v.role_id}</span></td>
<td data-label="Aksi">
    <div class="d-flex gap-1 justify-content-center">
        <button class="btn btn-outline-dark btn-sm" onclick="editUser(${v.id})">
            <i class="bi bi-pencil"></i> Edit
        </button>
        <button class="btn btn-dark btn-sm" onclick="deleteUser(${v.id})">
            <i class="bi bi-trash"></i> Delete
        </button>
    </div>
</td>
</tr>`;
                });

                $('#tbody').html(html);

                $('#myTable').DataTable({
                    responsive: false, 
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search users..."
                    }
                });

            })
            .fail(() => showAlert('Error', 'Failed to load user data', 'error'));
    }


    function saveUser() {
        const id = $('#user_id').val();
        const formData = $('#userForm').serialize();
        let url = `/user-update/${id}`;

        $.ajax({
                url: url,
                type: 'PUT',
                data: formData
            })
            .done(() => {
                $('#userModal').modal('hide');
                showAlert('Success', 'User updated successfully');
                loadUsers();
            })
            .fail(err => {
                showAlert('Error', err.responseJSON?.message ?? 'Failed to save user', 'error');
            });
    }

    function editUser(id) {
        $.get(`/user-show/${id}`)
            .done(res => {
                const d = res.data;
                resetForm();

                $('#user_id').val(d.id);
                $('#name').val(d.name);
                $('#email').val(d.email);

                setTimeout(() => {
                    $('#role_id').val(d.role_id).trigger('change');
                }, 100);

                $('#userModal').modal('show');
            })
            .fail(() => showAlert('Error', 'Failed to fetch user details', 'error'));
    }


    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This user will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#18181b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(res => {
            if (res.isConfirmed) {
                $.get(`/user-delete/${id}`) // Sesuai route GET Anda
                    .done(() => {
                        showAlert('Deleted', 'User has been removed');
                        loadUsers();
                    })
                    .fail(() => showAlert('Error', 'Delete failed', 'error'));
            }
        });
    }

    function resetForm() {
        $('#userForm')[0].reset();
        $('#user_id').val('');
        $('#email').val('');
        $('#role_id').val(null).trigger('change');
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
