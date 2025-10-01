<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Doa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .btn-sm {
            border-radius: 50px;
            padding: 0.3rem 0.8rem;
        }
        .arabic-text {
            font-family: "Scheherazade New", "Traditional Arabic", serif;
            font-size: 20px;
            direction: rtl;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-journal-text me-2"></i> Kelola Doa</h2>
        <a href="{{ route('doa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Doa
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-primary">
                <tr>
                    <th>Judul</th>
                    <th>Arab</th>
                    <th>Latin</th>
                    <th>Artinya</th>
                    <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($doas as $doa)
                    <tr>
                        <td>{{ $doa->judul }}</td>
                        <td class="arabic-text">{{ $doa->arab }}</td>
                        <td>{{ $doa->latin }}</td>
                        <td>{{ $doa->artinya }}</td>
                        <td class="text-center">
                            <a href="{{ route('doa.edit', $doa->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('doa.destroy', $doa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin hapus?')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada doa</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
