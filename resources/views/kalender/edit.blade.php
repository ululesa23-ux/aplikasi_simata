<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kalender Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h2 class="mb-4">Edit Kalender Akademik</h2>

    <form action="{{ route('kalender.update', $kalender->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $kalender->judul) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $kalender->tanggal_mulai) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $kalender->tanggal_selesai) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <input type="text" name="jenis" class="form-control" value="{{ old('jenis', $kalender->jenis) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $kalender->keterangan) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Unit</label>
            <select name="unit_id" class="form-control">
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ $kalender->unit_id == $unit->id ? 'selected' : '' }}>
                        {{ $unit->nama_unit }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('kalender.index') }}" class="btn btn-secondary">Batal</a>
    </form>

</body>
</html>
