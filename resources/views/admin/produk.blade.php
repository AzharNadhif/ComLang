@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold fs-3">Manajemen Produk</h1>
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProdukModal">
                <i class="bi bi-plus-circle me-2"> </i> Tambah Produk
            </button>
        </div>

        <!-- Modal Add Produk -->
        <div class="modal fade" id="addProdukModal" tabindex="-1" aria-labelledby="addProdukModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProdukModalLabel">Tambahkan Produk Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="gambar">Gambar Produk</label>
                                        <input type="file" name="gambar" id="gambar" class="form-control" required accept="image/*">
                                        <small class="text-muted">Ukuran maksimal: 2MB. Format: JPG, PNG, GIF</small>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="id_kategori">Kategori</label>
                                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategori as $kat)
                                                <option value="{{ $kat->id_kategori }}">{{ $kat->kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="harga">Harga (Rp)</label>
                                        <input type="number" name="harga" id="harga" class="form-control" required min="0">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="stok">Stok</label>
                                        <input type="number" name="stok" id="stok" class="form-control" required min="0">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Produk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $item)
                        <tr>
                            <td>{{ $item->id_produk }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>
                                <img src="{{ asset('images/produk/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" 
                                    class="img-thumbnail" style="max-height: 80px;">
                            </td>
                            <td>{{ $item->kategori->kategori ?? 'Tidak ada kategori' }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#editProdukModal{{ $item->id_produk }}">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteProduk({{ $item->id_produk }})">Hapus</button>
                                <form id="delete-form-{{ $item->id_produk }}" action="{{ route('admin.produk.destroy', $item->id_produk) }}" 
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    @foreach ($produk as $item)
        <div class="modal fade" id="editProdukModal{{ $item->id_produk }}" tabindex="-1" 
            aria-labelledby="editProdukModalLabel{{ $item->id_produk }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdukModalLabel{{ $item->id_produk }}">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.produk.update', $item->id_produk) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama_produk{{ $item->id_produk }}">Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk{{ $item->id_produk }}" 
                                            class="form-control" value="{{ $item->nama_produk }}" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="gambar{{ $item->id_produk }}">Gambar Produk</label>
                                        <input type="file" name="gambar" id="gambar{{ $item->id_produk }}" 
                                            class="form-control" accept="image/*">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                        <div class="mt-2">
                                            <img src="{{ asset('images/produk/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" 
                                                class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="id_kategori{{ $item->id_produk }}">Kategori</label>
                                        <select name="id_kategori" id="id_kategori{{ $item->id_produk }}" class="form-control" required>
                                            @foreach($kategori as $kat)
                                                <option value="{{ $kat->id_kategori }}" 
                                                    {{ $item->id_kategori == $kat->id_kategori ? 'selected' : '' }}>
                                                    {{ $kat->kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="harga{{ $item->id_produk }}">Harga (Rp)</label>
                                        <input type="number" name="harga" id="harga{{ $item->id_produk }}" 
                                            class="form-control" value="{{ $item->harga }}" required min="0">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="stok{{ $item->id_produk }}">Stok</label>
                                        <input type="number" name="stok" id="stok{{ $item->id_produk }}" 
                                            class="form-control" value="{{ $item->stok }}" required min="0">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="deskripsi{{ $item->id_produk }}">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi{{ $item->id_produk }}" 
                                            rows="4" class="form-control">{{ $item->deskripsi }}</textarea>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update Produk</button>
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
        document.querySelector('#addProdukModal form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan produk baru?',
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
        document.querySelectorAll('[id^="editProdukModal"] form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin memperbarui produk ini?',
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
        
        // Function to delete produk with confirmation
        function deleteProduk(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.',
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

        // Preview gambar sebelum upload
        document.getElementById('gambar').addEventListener('change', function() {
            const fileInput = this;
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Cek apakah ada preview sebelumnya, jika tidak buat elemen baru
                    let preview = document.getElementById('preview-add');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'preview-add';
                        preview.className = 'mt-2';
                        preview.innerHTML = '<img src="" class="img-thumbnail" style="max-height: 100px;">';
                        fileInput.parentNode.appendChild(preview);
                    }
                    // Update preview
                    preview.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        // Preview untuk form edit
        document.querySelectorAll('[id^="gambar"]').forEach(input => {
            if (input.id !== 'gambar') { // Skip the add form
                input.addEventListener('change', function() {
                    const fileInput = this;
                    if (fileInput.files && fileInput.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Update preview
                            const imgPreview = fileInput.parentNode.querySelector('img');
                            if (imgPreview) {
                                imgPreview.src = e.target.result;
                            }
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                });
            }
        });
    </script>
@endsection