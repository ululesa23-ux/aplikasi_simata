<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Doa</title>
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
            background: #ffc107;
            color: black;
            font-weight: 600;
            font-size: 1.2rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
        }
        .btn-warning, .btn-secondary {
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
                    <i class="bi bi-pencil-square me-2"></i> Edit Doa
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('doa.update', $doa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-fonts me-1"></i> Judul Doa</label>
                            <input type="text" name="judul" class="form-control" value="{{ $doa->judul }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-book me-1"></i> Teks Arab</label>
                            <textarea name="arab" class="form-control" rows="3" required>{{ $doa->arab }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-translate me-1"></i> Latin</label>
                            <textarea name="latin" class="form-control" rows="3" required>{{ $doa->latin }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-card-text me-1"></i> Artinya</label>
                            <textarea name="artinya" class="form-control" rows="3" required>{{ $doa->artinya }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('doa.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button class="btn btn-warning" type="submit">
                                <i class="bi bi-check-circle me-1"></i> Update
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
