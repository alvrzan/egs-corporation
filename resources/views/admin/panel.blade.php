<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Tambahkan link Bootstrap CSS atau CSS kustom Anda -->
    <link href="https://fonts.googleapis.com/css2?family=Athiti:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan gaya CSS kustom Anda di sini */
        body {
            font-family: Athiti, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #1d2f1a;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .container-fluid {
            display: flex;
            padding: 0;
            margin: 0;
        }
        .sidebar {
            background-color: #333;
            color: #fff;
            width: 250px;
            min-height: 100vh;
            /* padding-top: 20px; */
            position: sticky; /* Tambahkan properti sticky */
            top: 0; /* Atur posisi ke atas */
            z-index: 1; /* Atur z-index untuk muncul di atas konten */
            transition: all 0.3s;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            position: sticky; /* Tambahkan properti sticky */
            top: 20px; /* Sesuaikan dengan jarak dari atas yang Anda inginkan */
        }

        .sidebar li {
            margin-bottom: 10px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 5px 10px;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 100px;
            transition: all 0.3s;
        }

        /* Tambahkan CSS untuk responsif mobile */
        @media (max-width: 768px) {
            .container-fluid {
                flex-direction: column-reverse;
            }
            .sidebar {
                width: 100%;
                margin-left: -100%;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Panel</h1>
    </div>
    <div class="container-fluid">
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a href="{{ route('users.index') }}">Users</a></li>
                <li><a href="{{ route('home') }}">Home</a></li>
            </ul>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    <!-- Tambahkan script JavaScript jika diperlukan -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
