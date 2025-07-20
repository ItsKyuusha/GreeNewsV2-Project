@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="text-xl font-bold text-green-700">Manajemen Berita</h2>
  <a href="javascript:void(0)" onclick="openModal('create')" class="bg-green-700 text-white px-3 py-2 rounded">+ Tambah Berita</a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full border mt-2">
    <thead>
        <tr class="bg-green-100 text-left">
            <th class="p-2 text-center">No.</th>
            <th class="p-2">Judul</th>
            <th class="p-2">Publisher</th>
            <th class="p-2">Tanggal</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($beritas as $b)
        <tr class="border-t">
            <td class="p-2 text-center">{{ $loop->iteration }}</td>
            <td class="p-2">{{ $b->judul }}</td>
            <td class="p-2">{{ $b->publisher }}</td>
            <td class="p-2">{{ $b->tanggal }}</td>
            <td class="p-2 flex gap-1 text-center">
                <button onclick="openModal('show', {{ $b->id }})"
                    class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded flex items-center gap-1">
                    👁️ Lihat
                </button>
                <button onclick="openModal('edit', {{ $b->id }})"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded flex items-center gap-1">
                    ✏️ Edit
                </button>
                <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" class="delete-form">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded flex items-center gap-1">
                        🗑️ Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal SHOW -->
<div id="modal-show" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/2 max-w-lg shadow-lg">
        <h3 class="text-xl font-bold text-green-700 mb-4">Detail Berita</h3>
        <div id="show-judul" class="mb-2"><strong>Judul:</strong></div>
        <div id="show-tanggal" class="mb-2"><strong>Tanggal:</strong></div>
        <div id="show-isi" class="mb-2"><strong>Isi:</strong></div>
        <div id="show-publisher" class="mb-2"><strong>Publisher:</strong></div>
        <div id="show-gambar" class="mb-2"><strong>Gambar:</strong></div>
        <div class="mt-4 text-right">
            <button type="button" onclick="closeModal('show')" class="bg-gray-300 px-4 py-2 rounded">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal CREATE / EDIT -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/2 max-w-lg shadow-lg">
        <h3 class="text-xl font-bold text-green-700 mb-4" id="modal-title">Tambah Berita</h3>
        <form id="berita-form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="berita-id">
            <div class="mb-4">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="isi">Isi</label>
                <textarea name="isi" id="isi" class="w-full p-2 border rounded"></textarea>
            </div>
            <div class="mb-4">
                <label for="publisher">Publisher</label>
                <input type="text" name="publisher" id="publisher" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="w-full p-2 border rounded">
            </div>
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
                <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openModal(type, id = null) {
    const form = document.getElementById('berita-form');
    form.reset();
    document.getElementById('modal-title').textContent = type === 'create' ? 'Tambah Berita' : 'Edit Berita';

    // Hapus spoofing method lama jika ada
    const oldMethod = document.querySelector('#berita-form input[name="_method"]');
    if (oldMethod) oldMethod.remove();

    if (type === 'show') {
        document.getElementById('modal-show').classList.remove('hidden');
        fetch(`/admin/berita/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('show-judul').innerHTML = `<strong>Judul:</strong> ${data.judul}`;
                document.getElementById('show-tanggal').innerHTML = `<strong>Tanggal:</strong> ${data.tanggal}`;
                document.getElementById('show-isi').innerHTML = `<strong>Isi:</strong> ${data.isi}`;
                document.getElementById('show-publisher').innerHTML = `<strong>Publisher:</strong> ${data.publisher}`;
                document.getElementById('show-gambar').innerHTML = data.gambar
                    ? `<strong>Gambar:</strong><br><img src="/storage/${data.gambar}" class="w-full max-w-sm rounded">`
                    : `<strong>Gambar:</strong> <em>Tidak ada gambar</em>`;
            });
    } else {
        document.getElementById('modal').classList.remove('hidden');
        if (type === 'edit') {
            fetch(`/admin/berita/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('berita-id').value = data.id;
                    document.getElementById('judul').value = data.judul;
                    document.getElementById('tanggal').value = data.tanggal;
                    document.getElementById('isi').value = data.isi;
                    document.getElementById('publisher').value = data.publisher;
                    form.action = `/admin/berita/${id}`;
                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'PUT';
                    form.appendChild(method);
                });
        } else {
            form.action = "{{ route('admin.berita.store') }}";
        }
    }
}

function closeModal(type = 'form') {
    if (type === 'show') {
        document.getElementById('modal-show').classList.add('hidden');
    } else {
        document.getElementById('modal').classList.add('hidden');
    }
}

// SweetAlert2 confirm untuk hapus berita
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin menghapus berita ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#16a34a', // hijau
            cancelButtonColor: '#ef4444',  // merah
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

</script>
@endsection
