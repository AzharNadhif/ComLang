@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow rounded p-4" style="width: 400px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">{{ $admin->username }}</h5>
                <small class="text-muted">Admin Aktif</small>
            </div>
            <button class="btn btn-link text-dark" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="bi bi-pencil-square fs-4"></i>
            </button>
        </div>

        <table class="table table-borderless">
            <tr>
                <td class="fw-semibold">Username</td>
                <td>{{ $admin->username }}</td>
            </tr>
            <tr>
                <td class="fw-semibold">Password</td>
                <td>********</td>
            </tr>
        </table>

        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="button" class="btn btn-danger w-100" onclick="confirmLogout()">Log Out</button>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editProfileForm" method="POST" action="{{ route('admin.accounts.update') }}">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
            </div>
            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Success notification
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // Error notification
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // Validation errors
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
            // Show modal again if there were validation errors
            @if(old('username'))
                new bootstrap.Modal(document.getElementById('editProfileModal')).show();
            @endif
        @endif
    });

    // Handle profile edit form submission
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Simpan perubahan profil?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Handle logout confirmation
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>