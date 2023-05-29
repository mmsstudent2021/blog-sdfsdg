@extends('layouts.app')
@section('content')
    <div class=" container">
        <div class="row">
            <div class="col-12">
                <h3>Create New Article</h3>
                <hr>
                <form action="{{ route('article.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class=" form-label" for="">Article Title</label>
                        <input type="text" class=" form-control @error('title') is-invalid @enderror" name="title">
                        @error('title')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class=" form-label" for="">Description</label>
                        <textarea name="description" class=" form-control @error('description') is-invalid @enderror" rows="7"></textarea>
                        @error('description')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class=" btn btn-primary">Save Article</button>
                </form>
            </div>
        </div>
    </div>
@endsection
