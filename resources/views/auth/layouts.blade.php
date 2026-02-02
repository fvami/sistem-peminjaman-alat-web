<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoSiswa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="fixed top-5 right-5 z-[100] flex flex-col gap-3">
        <div class="toast-custom-container">
            @if (session('success'))
                <div class="toast-custom success">
                    <div class="toast-custom-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-custom-content">
                        <div class="toast-custom-title">Success</div>
                        <div class="toast-custom-message">{{ session('success') }}</div>
                    </div>
                    <div class="toast-custom-progress">
                        <div class="toast-custom-bar"></div>
                    </div>
                </div>
            @endif
            @if (session('error') || $errors->any())
                <div class="toast-custom error">
                    <div class="toast-custom-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="toast-custom-content">
                        <div class="toast-custom-title">Error</div>
                        <div class="toast-custom-message">
                            {{ session('error') ?? 'Data tidak valid!' }}
                        </div>
                    </div>
                    <div class="toast-custom-progress">
                        <div class="toast-custom-bar"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <a href="/" class="btn-back-link">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const duration = 5000;
            $('.toast-custom').each(function() {
                const $toast = $(this);
                const $bar = $toast.find('.toast-custom-bar');

                setTimeout(function() {
                    $toast.addClass('active');
                }, 100);

                $bar.css('transition', `width ${duration}ms linear`);

                setTimeout(function() {
                    $bar.css('width', '0%');
                }, 100);

                setTimeout(function() {
                    $toast.css({
                        transform: 'translateX(150%)',
                        opacity: '0'
                    });

                    setTimeout(function() {
                        $toast.remove();
                    }, 500);
                }, duration);
            });
        });
    </script>
</body>

</html>
