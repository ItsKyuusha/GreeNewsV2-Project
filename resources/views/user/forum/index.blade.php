@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4 text-green-700">Forum Komunitas</h2>
    @foreach ($forums as $f)
        <div class="bg-white shadow rounded p-4 mb-4">
            <h3 class="text-lg font-semibold">{{ $f->judul }}</h3>
            <p class="text-sm text-gray-500">oleh {{ $f->user->name }} - {{ $f->tanggal->format('d M Y') }}</p>
            <p class="mt-2 text-gray-700">{{ Str::limit($f->isi, 150) }}</p>
        </div>
    @endforeach
@endsection
