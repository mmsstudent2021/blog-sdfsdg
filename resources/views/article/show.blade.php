
@extends('layouts.app')
@section('content')
    <div class=" container">
        <div class="row">
            <div class="col-12">
                <h3>Article Detail</h3>
                <hr>

                <div class=" mb-3">
                    <a href="{{ route("article.create") }}" class="btn btn-outline-dark">Create</a>
                    <a href="{{ route("article.index") }}" class="btn btn-outline-dark">All Articles</a>
                </div>

                <div>
                    <h4>{{ $article->title }}</h4>
                    <div class="">
                        <span class=" badge bg-black">
                            {{ $article->category_id }}
                        </span>
                    </div>
                    <div class="">

                        {{ $article->description }}

                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
