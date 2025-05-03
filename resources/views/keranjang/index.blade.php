<div class="offcanvas offcanvas-end show" tabindex="-1" style="visibility: visible;" aria-modal="true" role="dialog">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Keranjang Saya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        @forelse($keranjang as $item)
            <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                <img src="{{ asset('images/produk/' . $item->produk->gambar) }}" alt="gambar" width="60" height="60" class="me-3 rounded">
                <div class="flex-grow-1">
                    <h6 class="mb-0">{{ $item->produk->nama_produk }}</h6>
                    <small class="text-muted">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</small>
                </div>
                <form action="{{ route('keranjang.hapus', $item->id_keranjang) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        @empty
            <p>Keranjang kosong.</p>
        @endforelse
    </div>
</div>
