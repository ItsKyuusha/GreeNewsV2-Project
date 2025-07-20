<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Panel - GreeNews</title>
    <link rel="shortcut icon" href="{{ asset('GREENEWS@2x.png') }}" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr CSS & JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-green-700 text-white min-h-screen flex flex-col">
        <div class="p-4 border-b border-green-800 flex flex-col items-center">
            <!-- Logo / Icon -->
            <img src="{{ asset('GREENEWS@2x.png') }}" alt="Logo" class="w-20 h-20 mb-2">
            <div class="font-bold text-lg">Admin Panel</div>
        </div>
        <nav class="p-4 space-y-2 text-sm flex-grow">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-green-600 {{ request()->routeIs('admin.dashboard') ? 'bg-green-800 font-semibold' : '' }}">
               📊 Dashboard
            </a>
            <a href="{{ route('admin.berita.index') }}"
               class="block px-3 py-2 rounded hover:bg-green-600 {{ request()->routeIs('admin.berita.*') ? 'bg-green-800 font-semibold' : '' }}">
               📰 Manage Berita
            </a>
            <a href="{{ route('admin.tanaman.index') }}"
               class="block px-3 py-2 rounded hover:bg-green-600 {{ request()->routeIs('admin.tanaman.*') ? 'bg-green-800 font-semibold' : '' }}">
               🌿 Manage Tanaman
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="block px-3 py-2 rounded hover:bg-green-600 {{ request()->routeIs('admin.users.*') ? 'bg-green-800 font-semibold' : '' }}">
               🧑‍💼 Manage Users
            </a>
            {{-- Tambahkan menu lain di sini --}}
        </nav>
    </aside>

    <!-- WRAPPER MAIN CONTENT -->
    <div class="flex flex-col flex-1 min-h-screen">

        <!-- HEADER -->
        <header class="bg-green-50 border-b border-gray-200 p-4 flex justify-between items-center">
            <div class="text-green-700 font-bold text-xl">
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-gray-700 font-semibold">
                    {{ Auth::user()->name ?? 'Anomali' }}
                </span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" id="logout-btn" class="inline-flex items-center justify-center p-1 text-gray-700 hover:text-red-600 hover:bg-gray-100 rounded transition" title="Logout">
                        <!-- Icon Logout (Door) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H9m4 4v1m0-10V5m-2-2h-2a2 2 0 00-2 2v2" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 bg-gray-50">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="bg-green-50 border-t border-gray-200 p-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} GreeNews. All rights reserved.
        </footer>

    </div>

    @yield('scripts')

    <script>
        document.getElementById('logout-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#16a34a', // Tailwind green-600
                cancelButtonColor: '#ef4444',  // Tailwind red-500
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form logout
                    document.getElementById('logout-form').submit();
                }
            });
        });

        // Toastr options
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        // Contoh menampilkan notifikasi logout sukses
        // Pastikan backend mengirim session flash 'success' setelah logout
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

</body>
</html>
