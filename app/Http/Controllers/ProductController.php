<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $tipos = Tipo::all();
        return view('products.create', compact('tipos'));
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
        $validateData = $request->validate([
            'title'=>['required'],
            'descricao'=>['required'],
            'preco'=>['required'],
            'lote'=>['required'],
            'avaliacao'=>['required'],
            'image'=> ['mimes:jpeg,png', 'dimensions:min_width=200,min_height=200'],
            'tipos_id'=>['array']
        ]);


        $product = new Product($validateData);

        $product->user_id = Auth::id();

        $product->save();

        $product->tipos()->attach($validateData['tipos_id']);

        if($request->hasFile('image') and $request->file('image')->isValid()){
            $extension = $request->image->extension();
            $image_name = now()->toDateTimeString()."_".substr(base64_encode(sha1(mt_rand())
            ), 0, 10);
            $path = $request->image->storeAs('products', $image_name.".".$extension, 'public');

            $image = new Image();
            $image->product_id = $product->id;
            $image->path = $path;
            $image->save();
        }
        
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
            $tipos = Tipo::all();
            return view('products.edit', compact('product', 'tipos'));
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
        $validateData = $request->validate([
            'title'=>['required'],
            'descricao'=>['required'],
            'preco'=>['required'],
            'lote'=>['required'],
            'avaliacao'=>['required'],
            'image'=> ['mimes:jpeg,png', 'dimensions:min_width=200,min_height=200'],
            'tipos_id'=>['array']
        ]);


        //$product = new Product($validateData);
        if($product->user_id === Auth::id()){
        
             $product->update($request->all());
             $product->tipos()->sync($validateData['tipos_id']);
             
             if($request->hasFile('image') and $request->file('image')->isValid()){
                 $product->image->delete();
                 
                 $extension = $request->image->extension();
                 $image_name = now()->toDateTimeString()."_".substr(base64_encode(sha1(mt_rand())
                ), 0, 10);
                $path = $request->image->storeAs('products', $image_name.".".$extension, 'public');
                
                $image = new Image();
                $image->path = $path;
                $image->product_id = $product->id;
                $image->save();
                
            }
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
            $path = $product->image->path;
            
            $product->delete();

            Storage::disk('public')->delete($path);

            return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso');;
        }else{
            return redirect()->back()
            ->with('error', 'Não pode deletar')
            ->withInput();
        }
    }
}
