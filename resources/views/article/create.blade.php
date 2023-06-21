@extends('layouts.app')
@section('content')
    <div class=" container">
        <div class="row">
            <div class="col-12">
                <h3>Create New Article</h3>
                <hr>
                <form action="{{ route('article.store') }}" id="createArticle" method="post" enctype="multipart/form-data">
                    @csrf

                </form>

                <div class="row">
                    <div class="col-lg-8">

                        <div class="mb-3">
                            <label class=" form-label" for="">Article Title</label>
                            <input form="createArticle" type="text" class=" form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" name="title">
                            @error('title')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class=" form-label" for="">Description</label>
                            <textarea form="createArticle" name="description" class=" form-control @error('description') is-invalid @enderror" rows="15">{{ old('description') }}</textarea>
                            @error('description')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class=" form-label" for="">Article Photo</label>
                            <div class=" border bg-light rounded single-photo-update d-flex justify-content-center align-items-center">

                                <div class=" text-center upload-logo">
                                    <i class=" bi bi-upload"></i>
                                    <p class=" mb-0">Click To Upload</p>
                                </div>




                            </div>

                            <input form="createArticle" type="file" accept="image/jpeg,image/png" class=" real-upload d-none form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">
                            @error('thumbnail')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class=" form-label" for="">Select Category</label>
                            <select form="createArticle" class=" form-select @error('category') is-invalid @enderror" name="category">

                                @foreach (App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach

                            </select>
                            @error('category')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <button form="createArticle" class=" w-100 d-block btn btn-primary">Save Article</button>
                    </div>
                </div>







            </div>
        </div>
    </div>


@endsection

@push('script')
    @vite(["resources/js/single-upload.js"])

@endpush
