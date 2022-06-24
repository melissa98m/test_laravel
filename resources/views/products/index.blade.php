@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <div class="tab-content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <h3>Liste des produits</h3>
                            <!--affiche les message de succées de creation-->
                            @if(session()->get('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div><br />
                            @endif
                            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">Ajouter un produit</a>
                            <!-- Tableau -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}} €</td>
                                        <td>{{$product->quantity}}</td>
                                        @if ($product->category)
                                        <td>{{$product->category->name }}</td>
                                        @else
                                            <td>Pas de catégorie</td>
                                        @endif
                                        <td>@foreach($product->tags as $tag)
                                                {{ $tag->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Editer</a>

                                            <form action="{{ route('products.destroy',$product->id) }}" method="post">
                                            @csrf
                                                @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"  onclick="return confirm('Voulez vous vraiment supprimer le produit?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Fin du Tableau -->
                            <a href="{{ route('categories.index') }}" class="btn btn-warning">Voir les catégories</a>
                            <a href="{{ route('tags.index') }}" class="btn btn-secondary">Voir les tags</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
