@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4 text-green-700">Informasi Tanaman</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($tanamans as $t)
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold">{{ $t->nama }}</h3>
                <p class="mt-2 text-gray-700">{{ Str::limit($t->deskripsi, 100) }}</p>
                <a href="{{ route('user.tanaman.show', $t->id) }}" class="text-green-700 font-semibold hover:underline">
                    Detail &rarr;
                </a>
            </div>
        @endforeach
    </div>
@endsection
