<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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
            color: #212529;
            font-weight: 600;
            font-size: 1.2rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
        }
        .btn-primary {
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
        }
        .btn-secondary {
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <i class="bi bi-pencil-square me-2"></i> Edit User
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

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-fill me-1"></i> Username</label>
                            <input type="text" name="username" class="form-control"
                                value="{{ old('username', $user->username) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-lock-fill me-1"></i> Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-phone me-1"></i> IMEI (Opsional)</label>
                            <input type="text" name="imei" class="form-control"
                                value="{{ old('imei', $user->imei) }}" placeholder="Masukkan IMEI device">
                            <small class="form-text text-muted">IMEI digunakan untuk tracking device user</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-shield-lock me-1"></i> Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>Admin</option>
                                <option value="tu" {{ old('role', $user->role)=='tu' ? 'selected' : '' }}>TU</option>
                                <option value="kabid" {{ old('role', $user->role)=='kabid' ? 'selected' : '' }}>Kabid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-building me-1"></i> Unit</label>
                            <select name="unit_id" class="form-select" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_id', $user->unit_id)==$unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama_unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
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
