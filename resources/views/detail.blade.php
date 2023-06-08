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

        @forelse ($article->comments as $comment)
            <div class=" card mb-3">
                <div class="card-body ">
                    <p class=" mb-0">
                        <i class="bi bi-chat-square-text-fill me-2"></i> {{ $comment->content }}
                    </p>

                    <div class="">

                        <span class=" badge bg-dark">
                            <i class=" bi bi-person"></i> {{ $comment->user->name }}
                        </span>

                        <span class=" badge bg-dark">
                            <i class=" bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                        </span>

                        @can('delete', $comment)
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class=" d-inline-block">
                                @csrf
                                @method('delete')
                                <button class=" badge border-0 bg-dark">
                                    <i class=" bi bi-trash3"></i> Delete
                                </button>
                            </form>
                        @endcan


                    </div>
                </div>
            </div>

        @empty

            <div class=" card mb-3">
                <div class="card-body text-center">
                    <p class=" mb-0">There is no comment yet !</p>
                </div>
            </div>
        @endforelse


        @auth
            <form action="{{ route('comment.store') }}" method="post">
                @csrf

                <input type="hidden" name="article_id" value={{ $article->id }}>
                <textarea name="content" class=" form-control mb-2" rows="3" placeholder="Say something about this article ...."></textarea>
                <div class=" d-flex justify-content-between align-items-end">
                    <p class=" mb-0">Commenting as {{ Auth::user()->name }}</p>
                    <button class="btn btn-sm btn-dark">Comment</button>
                </div>
            </form>

        @endauth



    </div>
@endsection
