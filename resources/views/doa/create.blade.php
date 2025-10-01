<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Doa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .card-header {
            background: #0d6efd;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
        }
        .btn-primary, .btn-secondary {
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card">
                <div class="card-header text-center">
                    <i class="bi bi-journal-plus me-2"></i> Tambah Doa Baru
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('doa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-fonts me-1"></i> Judul Doa</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-book me-1"></i> Teks Arab</label>
                            <textarea name="arab" class="form-control" rows="3" required>{{ old('arab') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-translate me-1"></i> Latin</label>
                            <textarea name="latin" class="form-control" rows="3" required>{{ old('latin') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-card-text me-1"></i> Artinya</label>
                            <textarea name="artinya" class="form-control" rows="3" required>{{ old('artinya') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('doa.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-check-circle me-1"></i> Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
