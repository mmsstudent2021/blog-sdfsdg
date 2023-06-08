@extends('layouts.master')


@section('content')
    <h3 class=" mb-2">
        <a href="" class=" text-decoration-none text-dark mb-0">
            {{ $article->title }}
        </a>
    </h3>
    <div class=" mb-4">
        <span class=" badge bg-dark">{{ $article->category->title ?? 'Unknown' }}</span>
        <span class=" badge bg-dark">{{ $article->created_at->format('d M Y') }}</span>
        <span class=" badge bg-dark">{{ $article->user->name }}</span>
    </div>
    <div class=" mb-3">
        {{ $article->description }}
    </div>
@endsection
