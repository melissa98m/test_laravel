<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $tags = Tag::all();
        return view('products.index', compact('products' , 'tags' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.create', compact('categories' , 'tags' ));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'quantity'=>'required',
            'category_id' => 'required',
        ]);
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id
        ]);

            $product->tags()->attach($request->tag_id);


        // ou Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Produit ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the product

        $product = Product::find($id);
        $category = $product->category->name;
        $tags = $product->tags;
        // show the view and pass the product to it
        return view('products.show', compact('product' , 'category' , 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $tags =Tag::all();

        return view('products.edit', compact('product' , 'categories', 'tags' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateProduct = $request->validate([
            'name' => 'required',
            'description'=>'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ]);

        Product::findOrFail($id)->tags()->sync($request->tag_id);
        Product::whereId($id)->update($updateProduct);

        return redirect()->route('products.index')
                         ->with('success', 'Le produit mis à jour avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return redirect('/products')->with('success', 'Produit supprimé');
    }

}
