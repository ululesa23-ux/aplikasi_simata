<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1 class="h4 mb-3">Tambah Barang</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kode</label>
            <input type="text" name="kode" class="form-control" value="{{ old('kode') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', 1) }}" min="0" required>
        </div>

        <!-- Dropdown Unit yayasan Permata Mojokerto -->
        <div class="mb-3">
            <label class="form-label">Unit</label>
            <select name="unit" class="form-select" required>
                <option value="">-- Pilih Unit --</option>
                <option value="Preschool Permata Mojokerto" {{ old('unit') == 'Preschool Permata Mojokerto' ? 'selected' : '' }}>Preschool Permata Mojokerto</option>
                <option value="PG Permata Mojokerto" {{ old('unit') == 'PG Permata Mojokerto' ? 'selected' : '' }}>PG Permata Mojokerto</option>
                <option value="TK Permata Mojokerto" {{ old('unit') == 'TK Permata Mojokerto' ? 'selected' : '' }}>TK Permata Mojokerto</option>
                <option value="TK Islam Platinum Permata Mojokerto" {{ old('unit') == 'TK Islam Platinum Permata Mojokerto' ? 'selected' : '' }}>TK Islam Platinum Permata Mojokerto</option>
                <option value="SDIT Permata Mojokerto" {{ old('unit') == 'SDIT Permata Mojokerto' ? 'selected' : '' }}>SDIT Permata Mojokerto</option>
                <option value="MIIT Permata Mojokerto" {{ old('unit') == 'MIIT Permata Mojokerto' ? 'selected' : '' }}>MIIT Permata Mojokerto</option>
                <option value="SMP Permata Mojokerto" {{ old('unit') == 'SMP Permata Mojokerto' ? 'selected' : '' }}>SMP Permata Mojokerto</option>
                <option value="MA Permata Mojokerto" {{ old('unit') == 'MA Permata Mojokerto' ? 'selected' : '' }}>MA Permata Mojokerto</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kondisi</label>
            <select name="kondisi" class="form-select">
                <option>Baik</option>
                <option>Rusak</option>
                <option>Perbaikan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">Batal</a>
    </form>

</body>
</html>
