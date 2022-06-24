@extends('layout')
@section('content')
    <h1>Détails sur : {{ $category->name }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-2"><strong>Nom:</strong>{{ $category->name }}</h5>
        </div>
    </div>


@endsection
