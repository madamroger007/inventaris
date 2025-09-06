<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Sekolah</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide-icons"></script>

    <!-- Animasi Fade -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>

    <!-- Tombol WhatsApp Fixed dengan pulse -->
    <a href="https://wa.me/6281234567890" target="_blank"
        class="fixed bottom-5 right-5 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg
          pulse hover:scale-110 transition transform duration-300 ease-in-out">
        <i class="fa-solid fa-robot w-6 h-6"></i>
    </a>

    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <h1 class="text-2xl font-extrabold text-blue-600 tracking-wide">
                Inventaris <span class="text-gray-800">Sekolah</span>
            </h1>

            <!-- Menu Desktop -->
            <nav class="hidden md:flex space-x-8 font-medium">
                <a href="#beranda" class="text-gray-700 hover:text-blue-600 transition font-bold">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-blue-600 transition font-bold">Tentang</a>
                <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition font-bold">Kontak</a>
            </nav>

            <!-- Tombol Mobile -->
            <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-7 w-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Menu Mobile -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <nav class="flex flex-col space-y-3 px-4 py-4">
                <a href="#beranda" class="text-gray-700 hover:text-blue-600 transition font-bold">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-blue-600 transition font-bold">Tentang</a>
                <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition font-bold">Kontak</a>
            </nav>
        </div>
    </header>


    <!-- Hero Section -->
    <section id="beranda" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    Sistem Inventaris & Peminjaman Barang Sekolah
                </h2>
                <p class="mt-4 text-lg text-blue-100">
                    Kelola penyimpanan dan peminjaman barang sekolah dengan lebih mudah dan cepat.
                </p>
                <a href="{{ route('peminjaman.index') }}"
                    class="mt-6 inline-block px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-blue-50 transition">
                    Peminjaman Barang
                </a>
            </div>
            <div class="flex-1 mt-10 md:mt-0">
                <img src="bg.png"
                    alt="Inventaris Sekolah"
                    class="w-full rounded-lg ">
            </div>
        </div>
    </section>


    <!-- Tentang -->
    <section id="tentang" class="py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-gray-800">Tentang Sistem</h3>
            <p class="text-gray-600 mt-4 leading-relaxed">
                Sistem ini membantu sekolah dalam mengelola inventaris barang seperti meja, kursi, alat praktik,
                dan peralatan elektronika. Dengan sistem ini, peminjaman barang lebih terstruktur
                dan pencarian barang lebih cepat.
            </p>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-16 bg-gray-100">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-gray-800">Kontak</h3>
            <p class="text-gray-600 mt-4">Hubungi kami untuk informasi lebih lanjut</p>
            <p class="mt-2 text-blue-600 font-semibold">Email: sman2majalaya@gmail.com</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t py-6 mt-10">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-600">
            &copy; {{ date('Y') }} Inventaris Sekolah. All rights reserved.
        </div>
    </footer>

    <div class="fixed bottom-5 right-5 flex flex-col items-end space-y-2 z-50">

        <!-- Popup Message -->
        <div id="chatbot-message"
            class="bg-white text-gray-800 px-4 py-2 rounded-lg shadow-lg border border-gray-200 text-sm mb-2 hidden animate-fade-in">
            👋 Halo! Butuh bantuan? Klik tombol ini untuk chat via WhatsApp.
        </div>

        <!-- Tombol WhatsApp Fixed -->
        <!-- Tombol WhatsApp Fixed -->
        <a href="https://wa.me/6285163185067?text=Halo%20saya%20mau%20bertanya%20tentang%20layanan%20Anda"
            target="_blank"
            class="relative bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg
   animate-bounce hover:scale-110 transition transform duration-300 ease-in-out">
            <i class="fa-solid fa-robot w-6 h-6"></i>
        </a>

    </div>


    <!-- Script untuk memunculkan popup otomatis -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const message = document.getElementById("chatbot-message");

            // Tampilkan popup setelah 2 detik
            setTimeout(() => {
                message.classList.remove("hidden");
            }, 2000);


        });
    </script>

    <!-- Aktifkan Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>