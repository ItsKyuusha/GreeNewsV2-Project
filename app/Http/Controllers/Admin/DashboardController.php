<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Tanaman;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $filter = request('filter', 'hari'); // default: bulan

        $totalBerita = Berita::count();
        $totalTanaman = Tanaman::count();
        $totalUser = User::where('role', 'user')->count();

        switch ($filter) {
            case 'hari':
                $berita = DB::table('beritas')
                    ->selectRaw('DAY(tanggal) as waktu, COUNT(*) as jumlah')
                    ->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $tanaman = DB::table('tanamans')
                    ->selectRaw('DAY(created_at) as waktu, COUNT(*) as jumlah')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $user = DB::table('users')
                    ->selectRaw('DAY(created_at) as waktu, COUNT(*) as jumlah')
                    ->where('role', 'user')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $labels = [];
                $range = range(1, 31);
                foreach ($range as $i) {
                    $labels[] = "Hari $i";
                }
                break;

            case 'tahun':
                $berita = DB::table('beritas')
                    ->selectRaw('YEAR(tanggal) as waktu, COUNT(*) as jumlah')
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $tanaman = DB::table('tanamans')
                    ->selectRaw('YEAR(created_at) as waktu, COUNT(*) as jumlah')
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $user = DB::table('users')
                    ->selectRaw('YEAR(created_at) as waktu, COUNT(*) as jumlah')
                    ->where('role', 'user')
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $labels = array_keys(array_replace($berita, $tanaman, $user));
                break;

            case 'bulan':
            default:
                $berita = DB::table('beritas')
                    ->selectRaw('MONTH(tanggal) as waktu, COUNT(*) as jumlah')
                    ->whereYear('tanggal', now()->year)
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $tanaman = DB::table('tanamans')
                    ->selectRaw('MONTH(created_at) as waktu, COUNT(*) as jumlah')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $user = DB::table('users')
                    ->selectRaw('MONTH(created_at) as waktu, COUNT(*) as jumlah')
                    ->where('role', 'user')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('waktu')
                    ->orderBy('waktu')
                    ->pluck('jumlah', 'waktu')
                    ->toArray();

                $bulanLabels = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                ];

                $labels = [];
                foreach (range(1, 12) as $bulan) {
                    $labels[] = $bulanLabels[$bulan];
                }
                break;
        }

        // Sesuaikan data ke array chart
        $beritaChart = [];
        $tanamanChart = [];
        $userChart = [];

        foreach ($labels as $index => $label) {
            $key = $filter === 'bulan' ? $index + 1 : ($filter === 'hari' ? $index + 1 : $label);

            $beritaChart[] = $berita[$key] ?? 0;
            $tanamanChart[] = $tanaman[$key] ?? 0;
            $userChart[] = $user[$key] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalTanaman',
            'totalUser',
            'labels',
            'beritaChart',
            'tanamanChart',
            'userChart'
        ));
    }
}
