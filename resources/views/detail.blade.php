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


    <div class=" comment">

        <h4>Comment & Reply</h4>

        @auth
            <form action="{{ route('comment.store') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="article_id" value={{ $article->id }}>
                <textarea name="content" class=" form-control mb-2" rows="3"></textarea>
                <div class=" d-flex justify-content-between align-items-end">
                    <p class=" mb-0">Commenting as {{ Auth::user()->name }}</p>
                    <button class="btn btn-sm btn-dark">Comment</button>
                </div>
            </form>

        @endauth

    </div>
@endsection
