@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold fs-3">Admin Accounts</h1>

            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                <i class="bi bi-plus-circle me-2"> </i> Add Admin
            </button>
        </div>

        <!-- Modal Add Admin -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Tambahkan Admin Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.accounts.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Admin -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    {{-- <th>Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->password }}</td>
                        {{-- <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editAdminModal{{ $admin->id_admin }}">Edit</button>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Edit Admin -->
    @foreach ($admins as $admin)
        <div class="modal fade" id="editAdminModal{{ $admin->id_admin }}" tabindex="-1" aria-labelledby="editAdminModalLabel{{ $admin->id_admin }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditAdminModalLabel">Edit Data Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.accounts.update', $admin->id_admin) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{ $admin->username }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password (Biarkan kosong jika tidak ingin diubah)</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update Admin</button>
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
    </script>
    <script>
        // Tambahkan di script SweetAlert2 yang sudah ada
        
        // Form add confirmation
        document.querySelector('#addAdminModal form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan admin baru?',
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
        document.querySelectorAll('[id^="editAdminModal"] form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin memperbarui data admin ini?',
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
    </script>
@endsection

