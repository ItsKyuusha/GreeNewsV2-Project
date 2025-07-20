@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4 text-green-700">Berita Pertanian Terbaru</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($beritas as $b)
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold">{{ $b->judul }}</h3>
                <p class="text-sm text-gray-500">{{ $b->publisher }} - {{ $b->tanggal->format('d M Y') }}</p>
                <p class="mt-2 text-gray-700">{{ Str::limit($b->isi, 100) }}</p>
                <a href="{{ route('user.berita.show', $b->id) }}" class="text-green-700 font-semibold hover:underline">
                    Baca Selengkapnya &rarr;
                </a>
            </div>
        @endforeach
    </div>
@endsection
