@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-green-700 mb-2">{{ $tanaman->nama }}</h2>
        @if($tanaman->gambar)
            <img src="{{ asset('storage/' . $tanaman->gambar) }}" alt="gambar tanaman" class="mb-4 rounded shadow">
        @endif
        <div class="text-gray-800 leading-relaxed">
            {!! nl2br(e($tanaman->deskripsi)) !!}
        </div>
        <div class="mt-6">
            <a href="{{ route('user.tanaman') }}" class="text-green-700 hover:underline">&larr; Kembali ke daftar tanaman</a>
        </div>
    </div>
@endsection
