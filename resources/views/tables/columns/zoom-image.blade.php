<div
    x-data="{ open: false }"
    class="flex items-center py-5"
    @keydown.escape.window="open = false">
    <!-- Thumbnail -->
    <img
        src="{{ asset('storage/' . $getState()) }}"
        alt="Foto Barang"
        class="w-16 h-16 object-cover rounded-md shadow cursor-pointer transition hover:opacity-80"
        @click="open = true">

    <!-- Modal -->
    <div
        x-show="open"
        x-transition.opacity
        style="display: none;"
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 p-4">
        <div class="relative">
            <!-- Gambar Besar -->
            <img
                src="{{ asset('storage/' . $getState()) }}"
                class="max-w-screen max-h-screen object-contain rounded-lg shadow-lg">

            <!-- Tombol Close -->
            <button
                @click="open = false"
                class="absolute -top-10 right-0 text-red-500 text-3xl font-bold hover:text-gray-300">✕</button>
        </div>
    </div>
</div>