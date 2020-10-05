@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edite o produto</h2>
        </div>
    </div>
</div>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Título:</strong>
                <input type="text" name="title" class="form-control" value="{{$product->title}}">
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Descrição:</strong>
                <textarea  name="descricao" class="form-control">{{$product->descricao}}</textarea>
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Preço:</strong>
                <input type="number" name="preco" class="form-control" value="{{$product->preco}}">
                </div>
         </div>
     </div>
     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Lote:</strong>
                <input type="number" name="lote" class="form-control" value="{{$product->lote}}">
                </div>
         </div>
     </div>
     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Avaliação:</strong>
                <input type="number" name="avaliacao" class="form-control" value="{{$product->avaliacao}}">
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong class ="col-2">Imagem:</strong>
                <img class="col-2" src="{{ asset('storage/'.$product->image->path) }}" alt="">
                <input class ="col-8" type="file" id="image" name="image" class="form-control">
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col text-center">
                
                <button type="submit" class="btn col btn-primary">UPDATE</button>
                
         </div>
     </div>

     

</form>


@endsection