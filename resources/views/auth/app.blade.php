<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1A5E63;
            --accent-color: #C69C6D;
            --teal-color: #53B8A3;
            --bg-light: #F7F6F2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            background: linear-gradient(135deg, var(--bg-light) 0%, #e3f4f1 100%);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 4px 0;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .navbar-brand img {
                height: 40px;
            }
        }

        /* Card */
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin: 8px auto;
            width: 90%;
            max-width: 950px;
        }

        .card-header {
            background: linear-gradient(90deg, var(--primary-color), var(--teal-color));
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            text-align: center;
            padding: 8px 0;
        }

        .card-body {
            padding: 12px 20px;
        }

        /* Form */
        .form-label {
            font-weight: 500;
            margin-bottom: 1px;
            font-size: 0.75rem;
        }

        .form-control {
            border-radius: 6px;
            font-size: 0.8rem;
            padding: 4px 8px;
        }

        .form-control:focus {
            border-color: var(--teal-color);
            box-shadow: 0 0 0 0.15rem #53b8a330;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.8rem;
            padding: 6px 16px;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
        }

        .btn-link {
            color: var(--teal-color);
            text-decoration: none;
            font-size: 0.75rem;
        }

        .btn-link:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        /* Layout */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        footer {
            text-align: center;
            padding: 5px 0;
            color: var(--primary-color);
            font-size: 0.7rem;
            background: #fff;
            border-top: 1px solid #ddd;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 10px 14px;
            }

            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            main {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container d-flex justify-content-right">
            <a class="navbar-brand" href="#">
                <img src="https://morchhadichai.co.in/public/img/images/morchhadi-logo-3.png" alt="Morchhadi Logo">
            </a>
        </div>
    </nav>
    @yield('content')
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>