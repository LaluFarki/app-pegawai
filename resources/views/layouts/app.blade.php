<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-g">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">App Pegawai</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">Departments</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('positions.index') }}">Positions</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('attendances.index') }}">Attendances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('salaries.index') }}">Gaji</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content') </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
