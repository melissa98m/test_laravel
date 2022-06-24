@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <div class="tab-content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <h3> Ajouter un produit</h3>
                            <!-- Message d'information -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Formulaire -->
                            <form method="POST" action="{{ route('products.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                                <div class=" row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Prix</span></label>
                                            <div class="input-group">
                                                <input type="number" name="price" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-6">
                                                <div class="form-group mb-4">
                                                    <label>Quantité</label>
                                                    <input type="number" name="quantity" class="form-control">
                                                </div>
                                    </div>

                                    <label class="label">Catégorie</label>
                                    <div class="select">
                                        <select name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="label">Tags</label>
                                    <div class="select">
                                        <select  name="tag_id[]" multiple="multiple" class="form-control">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        <button type="submit" class="btn btn-primary rounded">Créer un produit</button>
                            </form>
                            <!-- Fin du formulaire -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
