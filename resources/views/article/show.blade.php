@extends('layouts.app')
@section('content')
    <div class=" container">
        <div class="row">
            <div class="col-12">
                <h3>Article Detial</h3>
                <hr>
                <h4>
                    {{ $article->title }}
                </h4>
                <div class="">
                    {{ $article->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
