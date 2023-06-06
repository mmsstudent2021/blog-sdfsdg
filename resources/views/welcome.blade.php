@extends('layouts.app')

@section('content')
    <div class=" container">
        <div class="row justify-content-center">

            <div class="col-lg-8">
                @forelse ($articles as $article)
                    <div class=" card mb-3">
                        <div class=" card-body">
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
                                {{ Str::words($article->description, 30, '...') }}
                            </div>
                            <a href="{{ route("detail",$article->id) }}" class=" btn btn-dark">See More</a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
