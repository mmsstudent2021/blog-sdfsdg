@extends('layouts.master')

@section('content')
    @if (request()->has('keyword'))
        <div class=" d-flex justify-content-between">
            <p class=" mb-2 fw-bold">Showing result by ' {{ request()->keyword }} '</p>
            <a href="{{ route('index') }}" class=" text-dark">See All</a>
        </div>
    @endif

    @forelse ($articles as $article)
        <div class=" card mb-3">
            <div class=" card-body">
                <h3 class=" mb-2">
                    <a href="{{ route('detail', $article->slug) }}" class=" text-decoration-none text-dark mb-0">
                        {{ $article->title }}
                    </a>
                </h3>
                <div class=" mb-4">
                    <span class=" badge bg-dark">{{ $article->category->title ?? 'Unknown' }}</span>
                    <span class=" badge bg-dark">{{ $article->created_at->format('d M Y') }}</span>
                    <span class=" badge bg-dark">{{ $article->user->name }}</span>
                </div>
                <div class=" mb-3">
                    {{ Str::words($article->description, 30, '...') }}
                </div>
                <a href="{{ route('detail', $article->slug) }}" class=" btn btn-dark">See More</a>
            </div>
        </div>
    @empty
        <div class=" card">
            <div class=" card-body text-center">
                <h3>There is no article.U can create</h3>
                <a href=" {{ route('register') }} " class=" btn btn-outline-dark">Try Now</a>
            </div>
        </div>
    @endforelse
    <div class="">
        {{ $articles->onEachSide(1)->links() }}
    </div>
@endsection


