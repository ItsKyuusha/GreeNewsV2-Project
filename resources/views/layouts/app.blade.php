<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>GreeNews - Portal Informasi Seputar Pertanian</title>
    <link rel="shortcut icon" href="{{ asset('GREENEWS@2x.png') }}" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN untuk icon social -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-papb2xPv0LV4cCUrH6dE3mAOdk1swFhR3Tfsy4ihHxUuNz7U9EQQ2UHZELcRLoP6cg7hIjoXvm96uDL1zQ+log=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>
<body class="bg-green-50 font-sans">

<nav class="bg-white shadow-md sticky top-0 z-50">
  <div class="container mx-auto px-4 py-4 flex items-center justify-between flex-wrap">

    <!-- Logo -->
    <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 z-10">
      <img src="{{ asset('GREENEWS@2x.png') }}" alt="GreeNews Logo" class="w-20 h-20 object-contain" />
      <span class="text-2xl font-bold text-green-800 tracking-wide">GreeNews</span>
    </a>

    <!-- Mobile Menu Button -->
    <div class="md:hidden ml-auto">
      <button id="mobile-menu-button" class="text-green-800 focus:outline-none text-3xl">
        <i class="fas fa-bars"></i> <!-- Hamburger Icon -->
      </button>
    </div>

    <!-- Centered Navigation Links (Desktop) -->
    <div class="w-full md:w-auto md:flex-1 md:flex md:justify-center mt-4 md:mt-0">
      <ul id="nav-links" class="hidden md:flex flex-wrap justify-center space-x-4 text-green-900 font-medium text-base">
        <li class="nav-item"><a href="{{ route('user.dashboard') }}" class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('user.berita') }}" class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">Berita</a></li>
        <li class="nav-item"><a href="{{ route('user.tanaman') }}" class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">Tanaman</a></li>
        <li class="nav-item"><a href="{{ route('user.kalkulator') }}" class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">Kalkulator</a></li>
        <li class="nav-item"><a href="{{ route('user.forum') }}" class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">Forum</a></li>
        <li class="nav-item"><a href="{{ route('user.forum') }}" class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">Tentang Kami</a></li>
        <li class="nav-item"><a href="{{ route('user.forum') }}" class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">Kontak Kami</a></li>

        <!-- Dropdown Lainnya -->
        <li id="more-menu" class="relative hidden group">
          <button class="block px-2 py-1 hover:text-green-700 hover:underline underline-offset-4 transition">
            Lainnya <i class="fa fa-chevron-down text-sm ml-1"></i>
          </button>
          <ul id="more-items" class="absolute hidden group-hover:block bg-white rounded-md shadow-lg mt-2 w-40 z-50"></ul>
        </li>
      </ul>
    </div>

    <!-- Search & Auth (Right Side) -->
    <div class="hidden md:flex items-center space-x-4 z-10">
      <!-- Search -->
      <form action="" method="GET" class="relative">
        <input
          type="text"
          name="q"
          placeholder="Cari..."
          class="w-40 h-8 pl-3 pr-8 text-sm border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400"
        />
        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-green-500">
          <i class="fas fa-search"></i>
        </button>
      </form>

      <!-- Login/Register -->
      @auth
      <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="h-8 px-4 text-sm flex items-center justify-center bg-green-600 text-white hover:bg-green-500 rounded-md transition duration-200">
          Logout
        </button>
      </form>
      @else
      <a href="{{ route('login') }}" class="h-8 px-4 text-sm flex items-center justify-center border border-green-600 text-green-700 hover:bg-green-700 hover:text-white rounded-md transition duration-200">
        Login
      </a>
      <a href="{{ route('register') }}" class="h-8 px-4 text-sm flex items-center justify-center bg-green-600 text-white hover:bg-green-500 rounded-md transition duration-200">
        Register
      </a>
      @endauth
    </div>

    <!-- Mobile Nav (Dropdown) -->
    <div id="mobile-nav" class="w-full mt-4 hidden md:hidden">
      <div class="flex flex-col space-y-2 text-green-900 font-medium text-base">
        <a href="{{ route('user.dashboard') }}" class="hover:text-green-700">Dashboard</a>
        <a href="{{ route('user.berita') }}" class="hover:text-green-700">Berita</a>
        <a href="{{ route('user.tanaman') }}" class="hover:text-green-700">Tanaman</a>
        <a href="{{ route('user.kalkulator') }}" class="hover:text-green-700">Kalkulator</a>
        <a href="{{ route('user.forum') }}" class="hover:text-green-700">Forum</a>
        <a href="{{ route('user.forum') }}" class="hover:text-green-700">Tentang Kami</a>
        <a href="{{ route('user.forum') }}" class="hover:text-green-700">Kontak Kami</a>

        @auth
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="text-left text-green-700 hover:text-green-900">Logout</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="hover:text-green-700">Login</a>
        <a href="{{ route('register') }}" class="hover:text-green-700">Register</a>
        @endauth
      </div>
    </div>
  </div>
</nav>

<div class="container mx-auto mt-8 px-4">
    @yield('content')
</div>

<footer class="bg-gradient-to-tr from-green-700 via-green-800 to-green-900 text-white py-16 mt-20 shadow-inner">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 px-4">
        <!-- About -->
        <div>
            <h4 class="text-xl font-bold mb-5 border-b-4 border-green-400 pb-2 w-max">Tentang GreeNews</h4>
            <p class="text-green-200 leading-relaxed mb-4">
                GreeNews adalah portal informasi pertanian terdepan yang menyediakan berita, artikel, forum diskusi,
                dan berbagai alat bantu pertanian untuk membantu petani dan pegiat agrikultur.
            </p>
            <a href="tentang.html" class="inline-block bg-green-600 hover:bg-green-500 rounded-md px-4 py-2 transition font-semibold">
                Pelajari Lebih Lanjut
            </a>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="text-xl font-bold mb-5 border-b-4 border-green-400 pb-2 w-max">Link Cepat</h4>
            <ul class="space-y-3">
                <li><a href="{{ route('user.dashboard') }}" class="hover:text-green-300 transition">Dashboard Website</a></li>
                <li><a href="berita.html" class="hover:text-green-300 transition">Informasi Berita Terkini</a></li>
                <li><a href="tanaman.html" class="hover:text-green-300 transition">Informasi Seputar Tanaman</a></li>
                <li><a href="forum.html" class="hover:text-green-300 transition">Forum Komunitas Pertanian</a></li>
                <li><a href="kalkulator.html" class="hover:text-green-300 transition">Kalkulator Bidang Pertanian</a></li>
            </ul>
        </div>

        <!-- Contact & Social -->
        <div>
            <h4 class="text-xl font-bold mb-5 border-b-4 border-green-400 pb-2 w-max">Hubungi Kami</h4>
            <p class="text-green-200 mb-2"><i class="fas fa-phone-alt mr-2"></i> +62 812-3456-7890</p>
            <p class="text-green-200 mb-2"><i class="fas fa-envelope mr-2"></i> support@greene.ws</p>
            <p class="text-green-200 mb-6"><i class="fas fa-map-marker-alt mr-2"></i> Jl. Sawah Hijau No.12, Jakarta</p>
            <div class="flex space-x-6 text-green-200 hover:text-green-300 transition text-3xl mb-4 pl-4">
                <!-- Social Icons -->
                <a href="#" class="hover:text-green-300 transition">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="hover:text-green-300 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="hover:text-green-300 transition">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>

            <a href="kontak.html" class="inline-block bg-green-600 hover:bg-green-500 rounded-md px-4 py-2 transition font-semibold pl-4">
                Kirim Pesan
            </a>
        </div>

        <!-- Mini Map -->
        <div>
            <h4 class="text-xl font-bold mb-5 border-b-4 border-green-400 pb-2 w-max">Lokasi Kami</h4>
            <div class="rounded-lg overflow-hidden shadow-lg" style="height: 200px;">
                <iframe
                    class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=..."
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        </div>
    </div>

    <div class="text-center mt-12 border-t border-green-600 pt-6 text-green-300 select-none">
        © {{ date('Y') }} GreeNews - All Rights Reserved
    </div>
</footer>

@yield('scripts')

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const nav = document.getElementById("nav-links");
    const items = Array.from(nav.querySelectorAll(".nav-item"));
    const moreMenu = document.getElementById("more-menu");
    const moreItems = document.getElementById("more-items");

    function redistributeNavItems() {
      // Reset
      moreItems.innerHTML = "";
      moreMenu.classList.add("hidden");
      items.forEach(item => item.classList.remove("hidden"));

      const navRightEdge = nav.getBoundingClientRect().right;

      for (let i = 0; i < items.length; i++) {
        const item = items[i];
        const itemRight = item.getBoundingClientRect().right;

        if (itemRight > navRightEdge - 100) {
          moreMenu.classList.remove("hidden");

          const clone = item.cloneNode(true);
          clone.classList.remove("nav-item");
          moreItems.appendChild(clone);

          item.classList.add("hidden");
        }
      }
    }

    // Jalankan saat load dan resize
    redistributeNavItems();
    window.addEventListener("resize", redistributeNavItems);

    // Mobile menu toggle
    document.getElementById("mobile-menu-button").addEventListener("click", function () {
      const menu = document.getElementById("mobile-nav");
      menu.classList.toggle("hidden");
    });
  });
</script>

</body>
</html>
