<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 max-w-lg text-center">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
            Selamat Datang, Pengelola Inventaris! 📦
        </h1>
        <p class="text-gray-600 dark:text-gray-300 mb-6">
            Kelola data barang, pantau stok, dan pastikan inventaris selalu tertata rapi.
            Silakan masuk untuk memulai pengelolaan.
        </p>

        <div class="flex justify-center gap-4">
            @auth
            <a href="/admin"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Masuk ke Dashboard
            </a>
            @else
            <a href="/admin"
                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                Log in
            </a>

            @endauth
        </div>
    </div>

</body>

</html>