@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-green-700">Kalkulator Pertanian</h2>

<form method="POST" action="{{ route('user.kalkulator.hitung') }}" class="mb-4">
    @csrf
    <div class="mb-3">
        <label class="block font-medium mb-1">Pilih Jenis Kalkulator:</label>
        <select name="jenis" id="jenis" class="w-full border px-3 py-2" onchange="showForm()">
            <option value="">-- Pilih --</option>
            <option value="pupuk" {{ old('jenis') == 'pupuk' ? 'selected' : '' }}>Pupuk</option>
            <option value="bibit" {{ old('jenis') == 'bibit' ? 'selected' : '' }}>Bibit / Benih</option>
            <option value="biaya" {{ old('jenis') == 'biaya' ? 'selected' : '' }}>Biaya Tanam</option>
            <option value="keuntungan" {{ old('jenis') == 'keuntungan' ? 'selected' : '' }}>Keuntungan Panen</option>
            <option value="irigasi" {{ old('jenis') == 'irigasi' ? 'selected' : '' }}>Irigasi</option>
            <option value="kepadatan" {{ old('jenis') == 'kepadatan' ? 'selected' : '' }}>Kepadatan Tanam</option>
            <option value="pestisida" {{ old('jenis') == 'pestisida' ? 'selected' : '' }}>Kebutuhan Pestisida</option>
            <option value="kapur" {{ old('jenis') == 'kapur' ? 'selected' : '' }}>Takaran Kapur</option>
            <option value="ipt" {{ old('jenis') == 'ipt' ? 'selected' : '' }}>Indeks Pertumbuhan Tanaman (IPT)</option>
            <option value="produktivitas" {{ old('jenis') == 'produktivitas' ? 'selected' : '' }}>Perkiraan Hasil Panen</option>
            <option value="pemanenan"  {{ old('jenis') == 'pemanenan' ? 'selected' : '' }}>Biaya Pemanenan</option>
            <option value="kalender"  {{ old('jenis') == 'kalender' ? 'selected' : '' }}>Kalender Tanam</option>
            <option value="npk"  {{ old('jenis') == 'npk' ? 'selected' : '' }}>Pemupukan Berimbang (NPK)</option>
            <option value="penyusutan"  {{ old('jenis') == 'penyusutan' ? 'selected' : '' }}>Penyusutan Alat Pertanian</option>
            <option value="bep"  {{ old('jenis') == 'bep' ? 'selected' : '' }}>Break-Even Point (BEP)</option>
            <option value="konversi"  {{ old('jenis') == 'konversi' ? 'selected' : '' }}>Konversi Satuan</option>
            <option value="umur"  {{ old('jenis') == 'umur' ? 'selected' : '' }}>Estimasi Umur Tanaman</option>
            <option value="cuaca"  {{ old('jenis') == 'cuaca' ? 'selected' : '' }}>Analisis Risiko Cuaca</option>
        </select>
    </div>

    {{-- Semua form di bawah diberi class .form agar bisa disembunyikan/ditampilkan dinamis --}}
    <div id="form-pupuk" class="form hidden">
        <label>Luas Lahan (ha)</label>
        <input type="number" step="0.01" name="luas" class="w-full border px-3 py-2 mb-2">
        <label>Dosis Anjuran (kg/ha)</label>
        <input type="number" step="0.1" name="dosis" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-bibit" class="form hidden">
        <label>Luas Lahan (ha)</label>
        <input type="number" step="0.01" name="luas" class="w-full border px-3 py-2 mb-2">
        <label>Jarak Antar Barisan (cm)</label>
        <input type="number" name="jarak_barisan" class="w-full border px-3 py-2 mb-2">
        <label>Jarak Antar Tanaman (cm)</label>
        <input type="number" name="jarak_tanaman" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-biaya" class="form hidden">
        <label>Biaya Bibit (Rp)</label>
        <input type="number" name="bibit" class="w-full border px-3 py-2 mb-2">
        <label>Biaya Pupuk (Rp)</label>
        <input type="number" name="pupuk" class="w-full border px-3 py-2 mb-2">
        <label>Tenaga Kerja (Rp)</label>
        <input type="number" name="tenaga" class="w-full border px-3 py-2 mb-2">
        <label>Alat & Lainnya (Rp)</label>
        <input type="number" name="alat" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-keuntungan" class="form hidden">
        <label>Total Hasil Panen (kg)</label>
        <input type="number" name="hasil" class="w-full border px-3 py-2 mb-2">
        <label>Harga Jual per kg (Rp)</label>
        <input type="number" name="harga" class="w-full border px-3 py-2 mb-2">
        <label>Total Biaya (Rp)</label>
        <input type="number" name="biaya" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-irigasi" class="form hidden">
        <label>Luas Lahan (ha)</label>
        <input type="number" step="0.01" name="luas" class="w-full border px-3 py-2 mb-2">
        <label>Kebutuhan Air (liter/ha/hari)</label>
        <input type="number" name="kebutuhan" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-kepadatan" class="form hidden">
        <label>Jarak Antar Barisan (cm)</label>
        <input type="number" name="jarak_barisan" class="w-full border px-3 py-2 mb-2">
        <label>Jarak Antar Tanaman (cm)</label>
        <input type="number" name="jarak_tanaman" class="w-full border px-3 py-2 mb-2">
    </div>
    
    <div id="form-pestisida" class="form hidden">
        <label>Luas Lahan (ha)</label>
        <input type="number" name="luas" class="w-full border px-3 py-2 mb-2">
        <label>Dosis Anjuran (liter/ha)</label>
        <input type="number" step="0.01" name="dosis" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-kapur" class="form hidden">
        <label>pH Saat Ini</label>
        <input type="number" step="0.1" name="ph_awal" class="w-full border px-3 py-2 mb-2">
        <label>pH Target</label>
        <input type="number" step="0.1" name="ph_target" class="w-full border px-3 py-2 mb-2">
        <label>Jenis Tanah</label>
        <select name="jenis_tanah" class="w-full border px-3 py-2 mb-2">
            <option value="pasir">Pasir</option>
            <option value="lempung">Lempung</option>
            <option value="liat">Liat</option>
        </select>
    </div>

    <div id="form-ipt" class="form hidden">
        <label>Tinggi Tanaman (cm)</label>
        <input type="number" name="tinggi" class="w-full border px-3 py-2 mb-2">
        <label>Jumlah Daun</label>
        <input type="number" name="daun" class="w-full border px-3 py-2 mb-2">
        <label>Umur Tanaman (hari)</label>
        <input type="number" name="umur" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-produktivitas" class="form hidden">
        <label>Hasil Ubinan (kg per 2.5 m²)</label>
        <input type="number" step="0.1" name="hasil_ubin" class="w-full border px-3 py-2 mb-2">
    </div>
    
    <div id="form-pemanenan" class="form hidden">
        <label>Biaya Tenaga Kerja (Rp)</label>
        <input type="number" name="biaya_panen" class="w-full border px-3 py-2 mb-2">
        <label>Biaya Transportasi (Rp)</label>
        <input type="number" name="biaya_transport" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-kalender" class="form hidden">
        <label>Tanggal Tanam</label>
        <input type="date" name="tanggal_tanam" class="w-full border px-3 py-2 mb-2">
        <label>Durasi Tanam (hari)</label>
        <input type="number" name="durasi" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-npk" class="form hidden">
        <label>Luas Lahan (ha)</label>
        <input type="number" name="luas" class="w-full border px-3 py-2 mb-2">
        <label>Kebutuhan N (kg/ha)</label>
        <input type="number" name="n" class="w-full border px-3 py-2 mb-2">
        <label>Kebutuhan P (kg/ha)</label>
        <input type="number" name="p" class="w-full border px-3 py-2 mb-2">
        <label>Kebutuhan K (kg/ha)</label>
        <input type="number" name="k" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-penyusutan" class="form hidden">
        <label>Harga Alat (Rp)</label>
        <input type="number" name="harga" class="w-full border px-3 py-2 mb-2">
        <label>Umur Ekonomis (tahun)</label>
        <input type="number" name="umur" class="w-full border px-3 py-2 mb-2">
        <label>Nilai Sisa (Rp)</label>
        <input type="number" name="nilai_sisa" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-bep" class="form hidden">
        <label>Total Biaya Produksi (Rp)</label>
        <input type="number" name="biaya" class="w-full border px-3 py-2 mb-2">
        <label>Harga Jual per kg (Rp)</label>
        <input type="number" name="harga" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-konversi" class="form hidden">
        <label>Nilai</label>
        <input type="number" step="0.1" name="nilai" class="w-full border px-3 py-2 mb-2">
        <label>Satuan</label>
        <select name="satuan" class="w-full border px-3 py-2 mb-2">
            <option value="m2_ha">m² → ha</option>
            <option value="ton_kg">ton → kg</option>
            <option value="liter_cc">liter → cc</option>
        </select>
    </div>

    <div id="form-umur" class="form hidden">
        <label>Tanggal Tanam</label>
        <input type="date" name="tanggal_tanam" class="w-full border px-3 py-2 mb-2">
    </div>

    <div id="form-cuaca" class="form hidden">
        <label>Curah Hujan (mm)</label>
        <input type="number" name="hujan" class="w-full border px-3 py-2 mb-2">
        <label>Suhu (°C)</label>
        <input type="number" name="suhu" class="w-full border px-3 py-2 mb-2">
    </div>

    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-2">Hitung</button>
    <button type="button" onclick="resetFormInputs()" class="ml-2 bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded mt-2">Reset Form</button>
</form>

@if(session('hasil'))
        <div class="bg-green-100 text-green-800 p-4 rounded mt-4">
            <strong>Hasil:</strong> {{ session('hasil') }}
        </div>
    @endif
</div>

<script>
    function resetFormInputs() {
        const jenis = document.getElementById('jenis').value;

        // Kosongkan semua input dalam form yang sedang aktif, tapi jangan disembunyikan
        if (jenis) {
            const selectedForm = document.getElementById('form-' + jenis);
            if (selectedForm) {
                selectedForm.querySelectorAll('input, select').forEach(el => {
                    if (el.tagName.toLowerCase() === 'select') {
                        el.selectedIndex = 0;
                    } else {
                        el.value = '';
                    }
                });
            }
        }

        // Kosongkan hasil
        const hasilBox = document.querySelector('.bg-green-100');
        if (hasilBox) {
            hasilBox.remove();
        }
    }

    function showForm() {
        const jenis = document.getElementById('jenis').value;

        // Sembunyikan semua form dan nonaktifkan inputnya
        const allForms = document.querySelectorAll('.form');
        allForms.forEach(form => {
            form.classList.add('hidden');
            form.querySelectorAll('input, select').forEach(el => el.disabled = true);
        });

        // Tampilkan form yang sesuai
        if (jenis) {
            const selectedForm = document.getElementById('form-' + jenis);
            if (selectedForm) {
                selectedForm.classList.remove('hidden');
                selectedForm.querySelectorAll('input, select').forEach(el => el.disabled = false);
            }
        }
    }

    // Saat halaman selesai dimuat, tampilkan form dari old('jenis') (tetap tampil setelah submit)
    document.addEventListener('DOMContentLoaded', function () {
        const jenis = document.getElementById('jenis').value;
        if (jenis) {
            const selectedForm = document.getElementById('form-' + jenis);
            if (selectedForm) {
                selectedForm.classList.remove('hidden');
                selectedForm.querySelectorAll('input, select').forEach(el => el.disabled = false);
            }
        }
    });
</script>


@endsection