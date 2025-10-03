<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Unit - Rekapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h2 class="mb-4">Daftar Unit (Rekapan)</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Unit</th>
                <th>Kode Unit</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($units as $unit)
            <tr>
                <td>{{ $unit->nama_unit }}</td>
                <td>{{ $unit->kode_unit }}</td>
                <td>{{ $unit->deskripsi }}</td>
                <td>
                    <a href="{{ route('rekapan.show', $unit->id) }}?bulan={{ date('m') }}&tahun={{ date('Y') }}"
                       class="btn btn-info btn-sm">
                        Lihat Rekapan
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
