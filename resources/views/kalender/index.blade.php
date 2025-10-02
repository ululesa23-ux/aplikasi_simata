<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kalender Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h2 class="mb-4">Daftar Kalender Akademik</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kalender.create') }}" class="btn btn-primary mb-3">Tambah Kalender</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Unit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kalenders as $kalender)
            <tr>
                <td>{{ $kalender->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($kalender->tanggal_mulai)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($kalender->tanggal_selesai)->format('d/m/Y') }}</td>
                <td>{{ $kalender->jenis }}</td>
                <td>{{ $kalender->keterangan }}</td>
                <td>{{ $kalender->unit->nama ?? '-' }}</td>
                <td>
                    <a href="{{ route('kalender.edit', $kalender->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kalender.destroy', $kalender->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
