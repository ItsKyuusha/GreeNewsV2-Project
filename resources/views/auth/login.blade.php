@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <form method="POST" action="/login" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded" required>
        <button class="bg-green-700 text-white px-4 py-2 rounded">Login</button>
    </form>
    <p class="mt-4 text-sm">Belum punya akun? <a href="/register" class="text-green-700 underline">Daftar</a></p>
</div>
@endsection
