@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="text-xl font-bold text-green-700">Manajemen Tanaman</h2>
  <a href="javascript:void(0)" onclick="openModal('create')" class="bg-green-700 text-white px-3 py-2 rounded">+ Tambah Tanaman</a>
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
            <th class="p-2">Nama Tanaman</th>
            <th class="p-2">Deskripsi</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tanamans as $tanaman)
        <tr class="border-t">
            <td class="p-2 text-center">{{ $loop->iteration }}</td>
            <td class="p-2">{{ $tanaman->nama }}</td>
            <td class="p-2">{{ Str::limit($tanaman->deskripsi, 50) }}</td>
            <td class="p-2 flex gap-1">
                <button onclick="openModal('show', {{ $tanaman->id }})" class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded">👁️ Lihat</button>
                <button onclick="openModal('edit', {{ $tanaman->id }})" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded">✏️ Edit</button>
                <form action="{{ route('admin.tanaman.destroy', $tanaman->id) }}" method="POST" class="delete-form">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">🗑️ Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal CREATE / EDIT -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/2 max-w-lg shadow-lg">
        <h3 class="text-xl font-bold text-green-700 mb-4" id="modal-title">Tambah Tanaman</h3>
        <form id="tanaman-form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="tanaman-id">
            <div class="mb-4">
                <label for="nama" class="block">Nama Tanaman</label>
                <input type="text" name="nama" id="nama" class="border p-2 w-full rounded">
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="border p-2 w-full rounded"></textarea>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="border p-2 w-full rounded">
            </div>
            <div class="mb-4 flex justify-end gap-2">
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
                <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal SHOW -->
<div id="modal-show" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/2 max-w-lg shadow-lg">
        <h3 class="text-xl font-bold text-green-700 mb-4">Detail Tanaman</h3>
        <div class="mb-2"><strong>Nama:</strong> <span id="show-nama"></span></div>
        <div class="mb-2"><strong>Deskripsi:</strong> <span id="show-deskripsi"></span></div>
        <div class="mb-2"><strong>Gambar:</strong><div id="show-gambar" class="mt-2"></div></div>
        <div class="mt-4 text-right">
            <button type="button" onclick="closeModal('show')" class="bg-gray-300 px-4 py-2 rounded">Tutup</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openModal(type, id = null) {
        const form = document.getElementById('tanaman-form');
        const modal = document.getElementById('modal');
        form.reset();

        // Remove old _method if exists
        const oldMethod = form.querySelector('input[name="_method"]');
        if (oldMethod) oldMethod.remove();

        if (type === 'show') {
            document.getElementById('modal-show').classList.remove('hidden');
            fetch(`/admin/tanaman/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('show-nama').textContent = data.nama;
                    document.getElementById('show-deskripsi').textContent = data.deskripsi;
                    document.getElementById('show-gambar').innerHTML = data.gambar
                        ? `<img src="/storage/${data.gambar}" class="w-full max-w-sm rounded">`
                        : '<em class="text-gray-400">Tidak ada gambar</em>';
                });
        } else {
            modal.classList.remove('hidden');
            document.getElementById('modal-title').textContent = type === 'create' ? 'Tambah Tanaman' : 'Edit Tanaman';

            if (type === 'edit') {
                fetch(`/admin/tanaman/${id}/edit`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('tanaman-id').value = data.id;
                        document.getElementById('nama').value = data.nama;
                        document.getElementById('deskripsi').value = data.deskripsi;
                        form.action = `/admin/tanaman/${id}`;
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        form.appendChild(methodInput);
                    });
            } else {
                form.action = "{{ route('admin.tanaman.store') }}";
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

    // SweetAlert2 confirm untuk hapus tanaman
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin menghapus tanaman ini?',
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
