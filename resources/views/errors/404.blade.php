<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #ffffff;
            --text-main: #1a1a1a;
            --text-muted: #6c757d;
            --accent: #000000;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        /* Subtle Fade In Animation */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-num {
            font-size: clamp(5rem, 15vw, 10rem);
            font-weight: 600;
            letter-spacing: -0.05em;
            line-height: 1;
            margin-bottom: 1rem;
        }

        .divider {
            width: 50px;
            height: 2px;
            background-color: var(--accent);
            margin: 2rem 0;
        }

        .btn-outline-dark {
            border-radius: 0;
            /* Square edges for professional look */
            padding: 12px 35px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            transition: all 0.4s ease;
        }

        .btn-outline-dark:hover {
            background-color: var(--accent);
            color: #fff;
            transform: translateX(5px);
        }

        /* Background Soft Shapes (Agar tidak terlalu kosong tapi tetap elegan) */
        .bg-shape {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 40vw;
            height: 40vw;
            background: #f8f9fa;
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>

<body>

    <div class="bg-shape"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 reveal">
                <h1 class="error-num">404.</h1>
                <h2 class="h4 fw-light text-muted">Maaf, halaman ini sedang tidak di tempat.</h2>
                <div class="divider"></div>
                <p class="lead mb-5 text-secondary" style="max-width: 450px;">
                    Halaman yang Anda cari mungkin telah dipindahkan atau tidak lagi tersedia dalam sistem kami.
                </p>
                <a href="/" class="btn btn-outline-dark">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
