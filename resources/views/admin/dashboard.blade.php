@extends('layouts.admin')

@section('content')
<div>
    <h2 class="text-2xl font-bold text-green-700 mb-4">
        Halo, {{ auth()->user()->name }}! 🌿
    </h2>
    <p class="mb-6">Selamat datang di Panel Admin GreeNews.</p>

    <!-- Card Count -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <!-- Card Berita -->
        <div class="bg-green-300 shadow p-4 rounded flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-green-800">Total Berita</h3>
                <p class="text-2xl font-bold text-green-900">{{ $totalBerita }}</p>
            </div>
            <div class="text-green-700">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 012-2h8a2 2 0 012 2v14l-6-3-6 3V3z" />
                </svg>
            </div>
        </div>

        <!-- Card Tanaman -->
        <div class="bg-blue-300 shadow p-4 rounded flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-blue-800">Total Tanaman</h3>
                <p class="text-2xl font-bold text-blue-900">{{ $totalTanaman }}</p>
            </div>
            <div class="text-blue-700">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 016 6v1h1a2 2 0 012 2v5a2 2 0 01-2 2h-2.28a2 2 0 00-1.42.59l-.3.29a1 1 0 01-1.42 0l-.3-.3a2 2 0 00-1.42-.58H7a2 2 0 01-2-2v-5a2 2 0 012-2h1V8a6 6 0 016-6z" />
                </svg>
            </div>
        </div>

        <!-- Card User -->
        <div class="bg-yellow-300 shadow p-4 rounded flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-yellow-800">Total User</h3>
                <p class="text-2xl font-bold text-yellow-900">{{ $totalUser }}</p>
            </div>
            <div class="text-yellow-600">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zM3 13a2 2 0 012-2h10a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <form method="GET" class="mb-6">
        <label for="filter" class="font-semibold text-gray-700 mr-2">Tampilkan data berdasarkan:</label>
        <select name="filter" id="filter" onchange="this.form.submit()" class="border rounded px-3 py-1">
            <option value="hari" {{ request('filter') == 'hari' ? 'selected' : '' }}>Hari</option>
            <option value="bulan" {{ request('filter') == 'bulan' ? 'selected' : '' }}>Bulan</option>
            <option value="tahun" {{ request('filter') == 'tahun' ? 'selected' : '' }}>Tahun</option>
        </select>
    </form>

    @php
        $filterLabel = match(request('filter', 'hari')) {
            'bulan' => 'per Bulan',
            'tahun' => 'per Tahun',
            default => 'per Hari',
        };
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold text-green-700 mb-4">Statistik Konten {{ $filterLabel }}</h3>
        <canvas id="contentChart" height="100"></canvas>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold text-green-700 mb-4">Statistik Berita {{ $filterLabel }}</h3>
        <canvas id="beritaChart" height="100"></canvas>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold text-green-700 mb-4">Statistik Tanaman {{ $filterLabel }}</h3>
        <canvas id="tanamanChart" height="100"></canvas>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold text-green-700 mb-4">Statistik Pendaftaran User {{ $filterLabel }}</h3>
        <canvas id="userChart" height="100"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($labels) !!};

    // Chart Gabungan - Bar Chart
    new Chart(document.getElementById('contentChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'Berita',
                    data: {!! json_encode($beritaChart) !!},
                    backgroundColor: 'rgba(34, 197, 94, 0.6)',
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Tanaman',
                    data: {!! json_encode($tanamanChart) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });

    // Chart Berita - Bar Chart
    new Chart(document.getElementById('beritaChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Berita',
                data: {!! json_encode($beritaChart) !!},
                backgroundColor: 'rgba(22, 163, 74, 0.6)',
                borderColor: 'rgba(22, 163, 74, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });

    // Chart Tanaman - Bar Chart
    new Chart(document.getElementById('tanamanChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Tanaman',
                data: {!! json_encode($tanamanChart) !!},
                backgroundColor: 'rgba(37, 99, 235, 0.6)',
                borderColor: 'rgba(37, 99, 235, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });

    // Chart User - Bar Chart
    new Chart(document.getElementById('userChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'User Terdaftar',
                data: {!! json_encode($userChart) !!},
                backgroundColor: 'rgba(245, 158, 11, 0.6)', // amber-500
                borderColor: 'rgba(245, 158, 11, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
</script>
@endsection
