<div class="flex justify-center my-2">
    @php
        $gambar = null;
        if ($getState()['id_barang'] ?? null) {
            $barang = \App\Models\Barang::find($getState()['id_barang']);
            $gambar = $barang?->gambar;
        }
    @endphp

    @if($gambar)
        <img src="{{ asset('storage/' . $gambar) }}" class="max-w-sm h-auto rounded shadow" alt="Gambar Barang">
    @else
        <span class="text-gray-500">Belum dipilih</span>
    @endif
</div>
