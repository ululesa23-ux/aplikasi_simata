<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('/dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">Dashboard</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ url('/users') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Kelola User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/inventaris') }}" class="nav-link">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Kelola Inventaris</p>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->role === 'tu')
                        <li class="nav-item">
                            <a href="{{ url('/kalender') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>Kelola Kalender</p>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->role === 'kabid')
                        <li class="nav-item">
                            <a href="{{ url('/verifikasi') }}" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>Verifikasi Data</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-header px-3 py-2">
            <h1>@yield('page_title', 'Dashboard')</h1>
        </section>

        <section class="content px-3">
            @yield('content')
        </section>
    </div>

</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
