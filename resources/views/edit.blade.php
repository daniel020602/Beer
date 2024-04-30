@extends('layouts.app')

@section('content')
@auth
    <h2 class="">
        @if(isset($beer))
       
            <img src="{{$beer->image_url}}" style="max-width:100px; border-radius:2px;margin-right:5px" alt="sör képe">
        

            sör szerkesztése:
            <span class="text-secondary">{{ $beer->name }}</span>
        @else
            Új sör
        @endif
    </h2>

    <form
        class="row"
        action="{{ isset($beer) ? route('beers.update', $beer->id) : route('beers.store') }}"
        method="POST"
        enctype="multipart/form-data"
        >
        @csrf
        @if(isset($beer))
            @method('PUT')
        @endif
        {{--        @method(isset($book) ? 'PUT' : '')--}}
        <div class="col-8">
            <label for="name" class="form-label">sör neve</label>
            <input
                type="text"
                class="form-control @error('name')is-invalid @enderror"
                name="name"
                id="name"
                value="{{ old('name', isset($beer) ? $beer->name : '') }}"
            >
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-8">
            <label for="alc_content" class="form-label">alkoholtartalom</label>
            <input
                type="number"
                class="form-control @error('author')is-invalid @enderror"
                name="alc_content"
                id="alc_content"
                step="0.1"
                value="{{ old('alc_content', isset($beer) ? $beer->alc_content : '') }}"
            >
            @error('alc_content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-8">
            <label for="point" class="form-label">pontszám</label>
            <input
                type="number"
                min="0"
                max="10"
                class="form-control @error('year')is-invalid @enderror"
                name="point"
                id="point"
                
                value="{{ old('point', isset($beer) ? $beer->point : '') }}"
            >
            @error('point')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-8">
            <label for="type" class="form-label">típus</label>
            <div>
                <select name="type" id="type" class="form-select">
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ isset($beer) && $beer->type_id == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-8">
            <label for="csv" class="form-label">kép</label>
            <input
                type="file"
                class="form-control @error('image')is-invalid @enderror"
                name="image_url"
                id="image"
                value="{{ old('image', isset($beer) ? $beer->image : '') }}"
            >
            @if (isset($beer))
                <img src="{{ $beer->image }}" alt="" style="width: 150px;">
            @endif
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12 mt-3">
            <button class="btn btn-primary" type="submit">Mentés</button>
        </div>
    </form>
    @endauth
@endsection