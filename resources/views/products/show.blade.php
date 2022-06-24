@extends('layout')
@section('content')
<h1>Détails sur : {{ $product->name }}</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title m-2"><strong>Nom:</strong>{{ $product->name }}</h5>
        <p><strong>Categorie:</strong> {{ $category }}</p>
        <h6>Descritpion du produit :</h6>
        <p class="card-text">{{ $product->description }}</p>
        <p><strong>Prix:</strong> {{ $product->price }}€</p>
        <p><strong>Quantité:</strong> {{ $product->quantity }}</p>
    </div>
</div>


@endsection
