@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <x-card card-title="Dashboard" classes="mb-3">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} <i class=" bi bi-person"></i>

                    <br>

                    <code>
                        {{ Auth::user() }}
                    </code>

                    <br>
                    <br>

                    <x-alert message="min ga lar par" color="success" />
                    <x-alert message="san kyi tar par" color="info" />
                    <x-alert />
            </x-card>

            <x-card card-title="Card 2" >
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Et veniam iure architecto quas quia, alias ex libero accusantium dicta nihil quibusdam cumque, magnam labore? Eos suscipit magnam architecto harum asperiores.
                </p>
                <a href="#" class="btn btn-primary">Hello</a>
            </x-card>
            <x-card card-title="Card 3">

            </x-card>

        </div>
    </div>
</div>
@endsection
