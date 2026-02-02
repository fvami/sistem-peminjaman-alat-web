<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (auth()->user()->role_id === 2)
            Admin Dashboard
        @else
            Operator Dashboard
        @endif
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div id="wrapper">
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        @include('admin.partials.sidebar')

        <div id="page-content-wrapper">
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        timer: 2000,
                        showConfirmButton: false
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: "{{ session('error') }}",
                        confirmButtonColor: '#18181b',
                    });
                </script>
            @endif
            @include('admin.partials.navbar')

            <main class="container-fluid p-3 p-md-5">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('js')
    <script>
        const wrapper = document.getElementById("wrapper");
        const btn = document.getElementById("menu-toggle");
        const closeBtn = document.getElementById("close-sidebar");
        const overlay = document.getElementById("sidebar-overlay");

        function setSidebarStatus(isToggled) {
            if (isToggled) {
                wrapper.classList.add("toggled");
                localStorage.setItem("sidebar-state", "closed");
            } else {
                wrapper.classList.remove("toggled");
                localStorage.setItem("sidebar-state", "opened");
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const savedState = localStorage.getItem("sidebar-state");
            if (savedState === "closed") {
                wrapper.classList.add("toggled");
            } else {
                wrapper.classList.remove("toggled");
            }
        });

        if (btn) {
            btn.addEventListener("click", (e) => {
                e.stopPropagation();
                const isCurrentlyToggled = wrapper.classList.contains("toggled");
                setSidebarStatus(!isCurrentlyToggled);
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener("click", () => {
                setSidebarStatus(true);
            });
        }

        if (overlay) {
            overlay.addEventListener("click", () => {
                setSidebarStatus(true);
            });
        }
    </script>
</body>

</html>
