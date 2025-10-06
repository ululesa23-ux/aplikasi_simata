<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekapan Unit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h2 class="mb-4">Rekapan Presensi & Ijin - {{ $unit->nama_unit }}</h2>

    <div class="mb-3">
        <a href="{{ route('rekapan.index') }}" class="btn btn-secondary">← Kembali ke Daftar Unit</a>
    </div>

    <h4>Presensi</h4>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Total Hadir</th>
                <th>Total Pulang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($presensi as $p)
            <tr>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->total_hadir }}</td>
                <td>{{ $p->total_pulang }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data presensi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h4>Ijin</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Total Ijin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ijin as $i)
            <tr>
                <td>{{ $i->nama }}</td>
                <td>{{ $i->total_ijin }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center">Belum ada data ijin</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
