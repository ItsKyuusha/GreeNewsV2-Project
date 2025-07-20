@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-green-700 mb-2">{{ $berita->judul }}</h2>
        <p class="text-sm text-gray-500 mb-4">
            {{ $berita->publisher }} - {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
        </p>
        @if($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="gambar" class="mb-4 rounded shadow">
        @endif
        <div class="text-gray-800 leading-relaxed">
            {!! nl2br(e($berita->isi)) !!}
        </div>
        <div class="mt-6">
            <a href="{{ route('user.berita') }}" class="text-green-700 hover:underline">&larr; Kembali ke daftar berita</a>
        </div>
    </div>
@endsection
