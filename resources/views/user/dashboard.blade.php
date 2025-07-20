@extends('layouts.app')

@section('content')
    <!-- Carousel Section -->
    <div class="relative w-full h-[550px] rounded-xl overflow-hidden">
        <div class="overflow-hidden h-full rounded-xl">
            <div id="carousel" class="flex transition-transform duration-700 ease-in-out h-full group">
                <!-- Slide 1 -->
                <div class="carousel-item w-full flex-shrink-0 h-full flex items-center justify-center overflow-hidden transition-all duration-700 ease-in-out">
                    <img src="{{ asset('banner1.png') }}" class="max-w-full max-h-full object-contain rounded-3xl" alt="...">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item w-full flex-shrink-0 h-full flex items-center justify-center overflow-hidden transition-all duration-700 ease-in-out">
                    <img src="{{ asset('banner2.png') }}" class="max-w-full max-h-full object-contain rounded-3xl" alt="...">
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item w-full flex-shrink-0 h-full flex items-center justify-center overflow-hidden transition-all duration-700 ease-in-out">
                    <img src="{{ asset('banner3.png') }}" class="max-w-full max-h-full object-contain rounded-3xl" alt="...">
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="py-16 text-center animate-fadeInUp">
        <img src="{{ asset('GREENEWS_2x-removebg-preview.png') }}" alt="Logo" class="mx-auto mb-4 w-[125px] h-[125px]">
        <p class="text-xl font-semibold text-gray-700 mb-4">Selamat Datang di GreeNews, Portal Informasi Seputar Pertanian</p>
        <p class="text-lg text-gray-600 mb-6">Temukan Hal-Hal Tentang Pertanian Disini.</p>
        <a href="tentang.html" class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">Tentang Kami</a>
    </div>

    <!-- List Menu -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 mx-4 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 transform hover:-translate-y-1">
            <img src="{{ asset('iconberita.jpg') }}" class="w-full h-56 object-cover rounded-lg mb-4" />
            <div class="text-center">
                <a href="berita.html" class="text-lg font-extrabold text-gray-900 hover:text-green-600 transition-colors duration-300">
                    Berita
                </a>
                <p class="text-sm text-gray-500 mt-1 font-medium tracking-wide uppercase cursor-pointer hover:text-green-500 transition-colors duration-300">
                    Selengkapnya
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 transform hover:-translate-y-1">
            <img src="{{ asset('icontanaman.jpg') }}" class="w-full h-56 object-cover rounded-lg mb-4" />
            <div class="text-center">
                <a href="tanaman.html" class="text-lg font-extrabold text-gray-900 hover:text-green-600 transition-colors duration-300">
                    Tanaman
                </a>
                <p class="text-sm text-gray-500 mt-1 font-medium tracking-wide uppercase cursor-pointer hover:text-green-500 transition-colors duration-300">
                    Selengkapnya
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 transform hover:-translate-y-1">
            <img src="{{ asset('iconforum.jpg') }}" class="w-full h-56 object-cover rounded-lg mb-4" />
            <div class="text-center">
                <a href="form.php" class="text-lg font-extrabold text-gray-900 hover:text-green-600 transition-colors duration-300">
                    Forum
                </a>
                <p class="text-sm text-gray-500 mt-1 font-medium tracking-wide uppercase cursor-pointer hover:text-green-500 transition-colors duration-300">
                    Selengkapnya
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 transform hover:-translate-y-1">
            <img src="{{ asset('iconkalkulator.jpg') }}" class="w-full h-56 object-cover rounded-lg mb-4" />
            <div class="text-center">
                <a href="kalkulator.html" class="text-lg font-extrabold text-gray-900 hover:text-green-600 transition-colors duration-300">
                    Kalkulator Pertanian
                </a>
                <p class="text-sm text-gray-500 mt-1 font-medium tracking-wide uppercase cursor-pointer hover:text-green-500 transition-colors duration-300">
                    Selengkapnya
                </p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const carousel = document.getElementById("carousel");
        const slides = document.querySelectorAll(".carousel-item");
        let index = 0;
        const totalSlides = slides.length;

        function updateCarousel() {
            carousel.style.transform = `translateX(-${index * 100}%)`;

            slides.forEach((slide, i) => {
                slide.style.opacity = "0.5";
                slide.style.transform = "scale(0.9)";
                slide.style.zIndex = "1";

                if (i === index) {
                    slide.style.opacity = "1";
                    slide.style.transform = "scale(1)";
                    slide.style.zIndex = "10";
                }
            });
        }

        updateCarousel(); // Inisialisasi posisi dan efek pertama

        setInterval(() => {
            index = (index + 1) % totalSlides;
            updateCarousel();
        }, 3000);
    });
</script>
@endsection
