<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KalkulatorController extends Controller
{
    public function index()
    {
        return view('user.kalkulator.index');
    }

    public function hitung(Request $request)
    {
        $jenis = $request->jenis;

        switch ($jenis) {
            case 'pupuk':
                $luas = $request->luas;
                $dosis = $request->dosis;
                $total = $luas * $dosis;
                return back()->with('hasil', "Kebutuhan pupuk: $total kg");

            case 'bibit':
                $luas = $request->luas;
                $jarak_barisan = $request->jarak_barisan;
                $jarak_tanaman = $request->jarak_tanaman;
                $jumlah = ($luas * 10000) / ($jarak_barisan * $jarak_tanaman);
                return back()->with('hasil', "Jumlah bibit yang dibutuhkan: " . round($jumlah) . " butir/tanaman");

            case 'biaya':
                $total = $request->bibit + $request->pupuk + $request->tenaga + $request->alat;
                return back()->with('hasil', "Total biaya tanam: Rp " . number_format($total, 0, ',', '.'));

            case 'keuntungan':
                $hasil = $request->hasil * $request->harga;
                $untung = $hasil - $request->biaya;
                return back()->with('hasil', "Estimasi keuntungan: Rp " . number_format($untung, 0, ',', '.'));

            case 'irigasi':
                $luas = $request->luas;
                $kebutuhan = $request->kebutuhan;
                $total = $luas * $kebutuhan;
                return back()->with('hasil', "Kebutuhan air per hari: $total liter");

            case 'kepadatan':
                $jarak_barisan = $request->jarak_barisan;
                $jarak_tanaman = $request->jarak_tanaman;
                $jumlah = 10000 / (($jarak_barisan / 100) * ($jarak_tanaman / 100));
                return back()->with('hasil', "Jumlah tanaman per hektar: " . round($jumlah));

            case 'pestisida':
                $luas = $request->luas;
                $dosis = $request->dosis;
                $total = $luas * $dosis;
                return back()->with('hasil', "Kebutuhan pestisida: $total liter");

            case 'kapur':
                $ph_awal = $request->ph_awal;
                $ph_target = $request->ph_target;
                $jenis_tanah = $request->jenis_tanah;
                $faktor = $jenis_tanah === 'lempung' ? 1.5 : ($jenis_tanah === 'pasir' ? 0.8 : 1.2);
                $takaran = ($ph_target - $ph_awal) * 2 * $faktor;
                return back()->with('hasil', "Takaran kapur: " . round($takaran, 2) . " ton/ha");

            case 'ipt':
                $tinggi = $request->tinggi;
                $daun = $request->daun;
                $umur = $request->umur;
                $ipt = ($tinggi * $daun) / ($umur ?: 1);
                return back()->with('hasil', "Indeks Pertumbuhan Tanaman (IPT): " . round($ipt, 2));

            case 'produktivitas':
                $hasil_ubin = $request->hasil_ubin; // kg per 2.5 m²
                $luas_ubin = 2.5; // m²
                $ton_per_ha = ($hasil_ubin / $luas_ubin) * 10000 / 1000;
                return back()->with('hasil', "Estimasi hasil panen: " . round($ton_per_ha, 2) . " ton/ha");

            case 'pemanenan':
                $panen = $request->biaya_panen;
                $transport = $request->biaya_transport;
                return back()->with('hasil', "Biaya pemanenan total: Rp " . number_format($panen + $transport, 0, ',', '.'));

            case 'kalender':
                $tanam = Carbon::parse($request->tanggal_tanam);
                $panen = $tanam->addDays((int) $request->durasi);
                return back()->with('hasil', "Perkiraan tanggal panen: " . $panen->format('d M Y'));

            case 'npk':
                $n = $request->luas * $request->n;
                $p = $request->luas * $request->p;
                $k = $request->luas * $request->k;
                return back()->with('hasil', "N: $n kg, P: $p kg, K: $k kg");

            case 'penyusutan':
                $harga = $request->harga;
                $umur = $request->umur;
                $sisa = $request->nilai_sisa;
                $penyusutan = ($harga - $sisa) / $umur;
                return back()->with('hasil', "Penyusutan per tahun: Rp " . number_format($penyusutan, 0, ',', '.'));

            case 'bep':
                $biaya = $request->biaya;
                $harga = $request->harga;
                $bep = $biaya / $harga;
                return back()->with('hasil', "Break-Even Point: " . round($bep, 2) . " ton");

            case 'konversi':
                $nilai = $request->nilai;
                $satuan = $request->satuan;
                if ($satuan == 'm2_ha') {
                    $hasil = $nilai / 10000;
                    return back()->with('hasil', "$nilai m² = $hasil ha");
                } elseif ($satuan == 'ton_kg') {
                    $hasil = $nilai * 1000;
                    return back()->with('hasil', "$nilai ton = $hasil kg");
                } elseif ($satuan == 'liter_cc') {
                    $hasil = $nilai * 1000;
                    return back()->with('hasil', "$nilai liter = $hasil cc");
                } else {
                    return back()->with('hasil', "Satuan tidak dikenali.");
                }

            case 'umur':
                $tanam = Carbon::parse($request->tanggal_tanam);
                $hari = $tanam->diffInDays(Carbon::now(), false);
                $hari = $hari >= 0 ? $hari : 0;
                return back()->with('hasil', "Umur tanaman saat ini: $hari hari");

            case 'cuaca':
                $hujan = $request->hujan;
                $suhu = $request->suhu;
                $risiko = ($hujan < 50 || $suhu > 35 || $suhu < 20) ? 'Tinggi' : 'Rendah';
                return back()->with('hasil', "Analisis risiko cuaca: Risiko $risiko");

            default:
                return back()->with('hasil', 'Jenis kalkulasi tidak dikenali.');
        }
    }
}


