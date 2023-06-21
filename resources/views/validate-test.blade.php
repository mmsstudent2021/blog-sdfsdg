@extends('layouts.master')


@section('content')
    <h3>Validation Practice</h3>
    <hr>
    <form action="{{ route('validateCheck') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class=" form-label" for="">Article Title</label>
            <input type="text" class=" form-control @error('title') is-invalid @enderror"
            value="{{ old('title') }}"
                name="title">
            @error('title')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @php
            $genders = ['male', 'female', 'other'];
            // $townships = ['Bahan', 'Sanchaung', 'Tamwe', 'Thamine', 'Hlaing'];
        @endphp

        <div class="mb-3">
            <label class=" form-label">Gender</label>
            @foreach ($genders as $gender)
                <div class="form-check ">
                    <input class="form-check-input " type="radio" id="gender_{{ $gender }}"             name="gender"
                    value="{{ $gender }}"
                    {{ old('gender') === $gender ? "checked" : "" }}
                    >
                    <label class="form-check-label" for="gender_{{ $gender }}">
                        {{ $gender }}
                    </label>
                </div>
            @endforeach
            @error('gender')
                <div class=" text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="township">Select Township</label>
            <select class=" form-select @error('township') is-invalid @enderror" name="township" id="township">
                <option value="">Select One</option>

                @foreach (App\Models\Township::all() as $township)
                    <option
                    value="{{ $township->name }}"
                    {{ old('township') === $township->name ? "selected" : "" }}>
                    {{ $township->name }}
                    </option>
                @endforeach
            </select>

            @error('township')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label">Select Your Skills</label>
            @foreach (App\Models\Skill::all() as $skill)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                        name="skills[]"
                    id="skill_{{ $skill->title }}"
                    {{ in_array($skill->title,old('skills',[])) ? 'checked' : '' }}
                    value="{{ $skill->title }}">

                    <label class="form-check-label" for="skill_{{ $skill->title }}">
                    {{ $skill->title }}
                        </label>
                </div>
            @endforeach

            @error('skills')
                <div class=" text-danger small">{{ $message }}</div>
            @enderror
            @error('skills.*')
                <div class=" text-danger small">{{ $message }}</div>
            @enderror
        </div>

{{--
        <div class="mb-3">
            <label class=" form-label" for="">Photo Upload</label>
            <input type="file" class=" form-control @error('photo') is-invalid @enderror"
                name="photo">
            @error('photo')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="mb-3">
            <label class=" form-label" for="">Certificate Attachment</label>
            <input type="file" class=" form-control "
                name="certificates[]" multiple>
            @error('certificates')
                <div class=" text-danger small">{{ $message }}</div>
            @enderror
            @error('certificates.*')
                <div class=" text-danger small">{{ $message }}</div>
            @enderror
        </div>






        <button class=" btn btn-primary">Save Article</button>
    </form>
@endsection
