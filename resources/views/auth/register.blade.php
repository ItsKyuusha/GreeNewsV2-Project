@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Register</h2>
    <form method="POST" action="/register" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Nama" class="w-full p-2 border rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full p-2 border rounded" required>
        <button class="bg-green-700 text-white px-4 py-2 rounded">Register</button>
    </form>
</div>
@endsection
