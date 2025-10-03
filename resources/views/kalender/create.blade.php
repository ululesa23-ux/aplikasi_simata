<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kalender Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="container py-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-calendar-plus me-2"></i> Tambah Kalender Akademik</h4>
        </div>
        <div class="card-body">

            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kalender.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-type me-1"></i> Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-calendar-date me-1"></i> Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-calendar-date-fill me-1"></i> Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-list-task me-1"></i> Jenis</label>
                    <input type="text" name="jenis" class="form-control" value="{{ old('jenis') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-card-text me-1"></i> Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-building me-1"></i> Unit</label>
                    <select name="unit_id" class="form-select" required>
                        <option value="">-- Pilih Unit --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->nama_unit }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('kalender.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Batal
                    </a>
                    <button class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
