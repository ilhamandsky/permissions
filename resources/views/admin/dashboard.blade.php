<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Dashboard Admin - Manajemen Ruangan</h2>

        <!-- Form Tambah Ruangan -->
        <form action="{{ route('admin.rooms.store') }}" method="POST" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Nama Ruangan" required>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>

        <!-- Daftar Ruangan -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $index => $room)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $room->name }}</td>
                        <td>
                            <!-- Form Edit -->
                            <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $room->name }}" class="form-control d-inline w-50">
                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>

                            <!-- Form Hapus -->
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus ruangan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
