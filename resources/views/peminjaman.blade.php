{{-- resources/views/peminjaman.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-2xl">
        <h2 class="text-3xl font-bold mb-6 text-center">Form Peminjaman Barang</h2>

        {{-- Pesan sukses --}}
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
        @endif

        {{-- Pesan error --}}
        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nama Peminjam --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Peminjam</label>
                <input type="text" name="nama_peminjam"
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    value="{{ old('nama_peminjam') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">No HP</label>
                <input type="number" name="nohp"
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    value="{{ old('nohp') }}" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    value="{{ old('email') }}" required>
            </div>


            <div>
                <label class="block text-gray-700 font-medium mb-1">Alamat</label>
                <textarea name="alamat" id=""
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>{{ old('alamat') }}</textarea>
            </div>

            {{-- Barang --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Pilih Barang</label>
                <select name="id_barang"
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($data_barang as $barang)
                    <option value="{{ $barang->id }}" {{ old('id_barang') == $barang->id ? 'selected' : '' }}>
                        {{ $barang->nama }} (Stok: {{ $barang->jumlah }})
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Jumlah</label>
                <input type="number" name="jumlah" min="1"
                    class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    value="{{ old('jumlah') }}" required>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between pt-4">
                <a href="/"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">Kembali</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</body>

</html>
