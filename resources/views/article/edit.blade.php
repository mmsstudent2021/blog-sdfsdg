@extends('layouts.app')
@section('content')
    <div class=" container">
        <div class="row">
            <div class="col-12">
                <h3>Edit Article</h3>
                <hr>
                <form id="updateArticle" action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                </form>

                <div class="row">
                    <div class="col-lg-8">

                        <div class="mb-3">
                            <label class=" form-label" for="">Article Title</label>
                            <input form="updateArticle" type="text"
                                class=" form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $article->title) }}" name="title">
                            @error('title')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class=" form-label" for="">Description</label>
                            <textarea form="updateArticle" name="description" class=" form-control @error('description') is-invalid @enderror"
                                rows="15">{{ old('description', $article->description) }}</textarea>
                            @error('description')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class=" form-label" for="">Thumbnail</label>
                            <div style="background-image: url({{ asset(Storage::url($article->thumbnail)) }}); "
                                class=" border bg-light rounded single-photo-update d-flex justify-content-center align-items-center">

                                {{-- @if ($article->thumbnail)
                                    <div class="d-flex flex-column">
                                        <img src="{{ asset(Storage::url($article->thumbnail)) }}" style="height: 100px;">
                                        <button class="btn btn-sm btn-danger">
                                            <i class=" bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endif --}}



                                <div class=" text-center upload-logo">
                                    <i class=" bi bi-upload"></i>
                                    <p class=" mb-0">Click To Upload</p>
                                </div>




                            </div>

                            <input form="updateArticle" type="file" accept="image/jpeg,image/png"
                                class=" real-upload d-none form-control @error('thumbnail') is-invalid @enderror"
                                name="thumbnail">
                            @error('thumbnail')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class=" form-label" for="">Photos</label>


                            <form id="articlePhotoUpload" action="{{ route("photo.store") }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <input type="file" accept="image/jpeg,image/png"
                                class=" multiple-upload form-control  @error('photos') is-invalid @enderror" name="photos[]"
                                multiple>

                            </form>
                            @error('photos')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('photos.*')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if(!is_null($article->photos))
                                <label class=" form-label mt-2" for="">Current Photos</label>
                                <div class="d-flex">

                                    @foreach ($article->photos as $photo)

                                    <div class=" position-relative">
                                        <img src="{{ asset(Storage::url($photo->address)) }}" class="article-img" alt="">
                                            <form action="{{ route("photo.destroy",$photo->id) }}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button class=" btn btn-sm btn-danger position-absolute bottom-0 end-0">
                                                    <i class=" bi bi-trash"></i>
                                                </button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class=" form-label" for="">Select Category</label>
                            <select form="updateArticle" class=" form-select @error('category') is-invalid @enderror"
                                name="category">

                                @foreach (App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category',$article->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach

                            </select>
                            @error('category')
                                <div class=" invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- {{ dd($article->tags->pluck("pivot.tag_id")->toArray()) }} --}}

                        <div class="mb-3">
                            <label class=" form-label">Select Your tags</label>
                            @foreach (App\Models\Tag::all() as $tag)
                                <div class="form-check">
                                    <input form="updateArticle" class="form-check-input" type="checkbox" name="tags[]"
                                        id="tag_{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', $article->tags->pluck("pivot.tag_id")->toArray())) ? 'checked' : '' }}
                                        value="{{ $tag->id }}">

                                    <label class="form-check-label" for="tag_{{ $tag->id }}">
                                        {{ $tag->title }}
                                    </label>
                                </div>
                            @endforeach

                            @error('tags')
                                <div class=" text-danger small">{{ $message }}</div>
                            @enderror
                            @error('tags.*')
                                <div class=" text-danger small">{{ $message }}</div>
                            @enderror
                        </div>



                        <button form="updateArticle" class=" w-100 d-block btn btn-primary">Update Article</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @vite(["resources/js/single-upload.js"])

@endpush

