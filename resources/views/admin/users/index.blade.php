@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="text-xl font-bold text-green-700">Manajemen User</h2>
  <a href="javascript:void(0)" onclick="openModal('create')" class="bg-green-700 text-white px-3 py-2 rounded">+ Tambah User</a>
</div>
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Tabel -->
<table class="w-full border bg-white shadow-sm">
    <thead>
        <tr class="bg-green-100">
            <th class="p-2 text-center">No.</th>
            <th class="p-2">Nama</th>
            <th class="p-2">Email</th>
            <th class="p-2">Role</th> {{-- Tambahkan ini --}}
            <th class="p-2">Dibuat</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-t">
            <td class="p-2 text-center">{{ $loop->iteration }}</td>
            <td class="p-2">{{ $user->name }}</td>
            <td class="p-2">{{ $user->email }}</td>
            <td class="p-2 capitalize">{{ $user->role }}</td> {{-- Tambahkan ini --}}
            <td class="p-2">{{ $user->created_at->format('d M Y') }}</td>
            <td class="p-2 flex gap-2">
                <button 
                    onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" 
                    class="text-blue-600">
                    Edit
                </button>
                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="delete-form">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Tambah -->
<div id="modal-create" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Tambah User</h3>
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <input name="name" placeholder="Nama" class="w-full p-2 border mb-2 rounded" required>
            <input name="email" placeholder="Email" type="email" class="w-full p-2 border mb-2 rounded" required>
            <select name="role" class="w-full p-2 border mb-2 rounded" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input name="password" placeholder="Password" type="password" class="w-full p-2 border mb-2 rounded" required>
            <input name="password_confirmation" placeholder="Konfirmasi Password" type="password" class="w-full p-2 border mb-4 rounded" required>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('create')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button class="bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modal-edit" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Edit User</h3>
        <form id="form-edit" method="POST">
            @csrf @method('PUT')
            <input id="edit-name" name="name" placeholder="Nama" class="w-full p-2 border mb-2 rounded" required>
            <input id="edit-email" name="email" placeholder="Email" type="email" class="w-full p-2 border mb-2 rounded" required>
            <select id="edit-role" name="role" class="w-full p-2 border mb-2 rounded" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input name="password" placeholder="Password (kosongkan jika tidak diubah)" type="password" class="w-full p-2 border mb-2 rounded">
            <input name="password_confirmation" placeholder="Konfirmasi Password" type="password" class="w-full p-2 border mb-4 rounded">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('edit')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button class="bg-green-700 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Script Modal -->
<script>
    function openModal(type) {
        document.getElementById('modal-' + type).classList.remove('hidden');
    }

    function closeModal(type) {
        document.getElementById('modal-' + type).classList.add('hidden');
    }

    function openEditModal(id, name, email, role) {
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-role').value = role;

        const form = document.getElementById('form-edit');
        form.action = `/admin/users/${id}`;

        openModal('edit');
    }

    // SweetAlert2 confirm untuk hapus user
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus user ini?',
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
