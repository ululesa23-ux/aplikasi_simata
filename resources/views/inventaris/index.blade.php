<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Daftar Inventaris</h1>
        <a href="{{ route('inventaris.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>

    <form method="GET" action="{{ route('inventaris.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Cari nama atau kode...">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Tgl Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventaris as $item)
                <tr>
                    <td>{{ $item->kode }}</td>
                    <td>
                        {{ $item->nama }}
                        @if($item->foto)
                            <br><small><a target="_blank" href="{{ asset('storage/'.$item->foto) }}">Lihat foto</a></small>
                        @endif
                    </td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->tanggal_masuk?->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('inventaris.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus barang?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $inventaris->links() }}

</body>
</html>
