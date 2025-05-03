@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold fs-3">Category Management</h1>

            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
                <i class="bi bi-plus-circle me-2"> </i> Add Category
            </button>
        </div>

        <!-- Modal Add Kategori -->
        <div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKategoriModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="kategori">Nama Kategori</label>
                                <input type="text" name="kategori" id="kategori" class="form-control" required>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Kategori -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Number ofProduct</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $kat)
                    <tr>
                        <td>{{ $kat->id_kategori }}</td>
                        <td>{{ $kat->kategori }}</td>
                        <td>{{ $kat->products->count() }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $kat->id_kategori }}">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteKategori({{ $kat->id_kategori }})">Delete</button>
                            <form id="delete-form-{{ $kat->id_kategori }}" action="{{ route('admin.kategori.destroy', $kat->id_kategori) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Edit Kategori -->
    @foreach ($kategori as $kat)
        <div class="modal fade" id="editKategoriModal{{ $kat->id_kategori }}" tabindex="-1" aria-labelledby="editKategoriModalLabel{{ $kat->id_kategori }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.kategori.update', $kat->id_kategori) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="kategori">Nama Kategori</label>
                                <input type="text" name="kategori" id="kategori" class="form-control" value="{{ $kat->kategori }}" required>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update Kategori</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- SweetAlert2 Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Alert untuk success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // Alert untuk error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // Alert untuk validation errors
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Error',
                    html: `@foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach`,
                });
            @endif
        });
        
        // Form add confirmation
        document.querySelector('#addKategoriModal form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan kategori baru?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tambahkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
        
        // Form edit confirmation - for all edit forms
        document.querySelectorAll('[id^="editKategoriModal"] form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin memperbarui kategori ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Perbarui',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
        
        // Function to delete kategori with confirmation
        function deleteKategori(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection