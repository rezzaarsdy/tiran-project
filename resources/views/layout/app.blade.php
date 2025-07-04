<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('up')
</head>
<body>
<div class="container py-5">
    @yield('content')
</div>

@stack('down')

<script>
    // Fungsi pencarian
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#karyawanTable tbody tr');

        rows.forEach(row => {
            const nama = row.cells[1].textContent.toLowerCase();
            row.style.display = nama.includes(searchValue) ? '' : 'none';
        });
    });
</script>
</body>
</html>
