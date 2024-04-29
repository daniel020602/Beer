@extends('layouts.app')

@section('content')
    <div>
        <a class="btn btn-primary" href="{{ route('beers.create') }}">Új sör</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>név</th>
            <th>alkoholtartalom</th>
            <th>pontszám</th>
            <th>típus</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($beers as $beer)
            <tr>
                <td>{{ $beer->id }}</td>
                <td>
                    <a class="text-decoration-none d-block" href="{{ route('beers.edit', $beer->id) }}">
                        {{ $beer->name }}
                    </a>
                </td>
                <td>{{ $beer->alc_content }}</td>
                <td>{{ $beer->point }}</td>
                <td>{{ $beer->title}}</td>
                <td class="d-flex">
                    <form class="ms-auto btn-group" action="{{ route('beers.destroy', $beer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">DEL</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection