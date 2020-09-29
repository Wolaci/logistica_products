<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::where('user_id', Auth::id())
       ->orderBy('created_at', 'desc')
       ->paginate(3);
       return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Product::create($request->all());
        $product = new Product($request->all());

        $product->user_id = Auth::id();

        $product->save();
        
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product->user_id === Auth::id()){
        return view('products.edit', compact('product'));
        }else{
            return redirect()->route('products.index')
            ->with('error', 'Não pode editar')
            ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($product->user_id === Auth::id()){
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produto editado com sucesso');;
        }else{
            return redirect()->route('products.index')
            ->with('error', 'Não pode editar')
            ->withInput();
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->user_id === Auth::id()){

            
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso');;
        }else{
            return redirect()->back()
            ->with('error', 'Não pode deletar')
            ->withInput();
        }
    }
}
