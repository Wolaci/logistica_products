@extends('layouts.app')
@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
  <strong>Ops!</strong> Ouve um problema <br><br>
  <ul>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
  @endforeach
  </ul>
  </div>
@endif


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create a new Product</h2>
        </div>
    </div>
</div>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Título:</strong>
                <input type="text" name="title" class="form-control" >
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Descrição:</strong>
                <textarea  name="descricao" class="form-control" > </textarea>
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Preço:</strong>
                <input type="number" name="preco" class="form-control">
                </div>
         </div>
     </div>
     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Lote:</strong>
                <input type="number" name="lote" class="form-control" >
                </div>
         </div>
     </div>
     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Avaliação:</strong>
                <input type="number" name="avaliacao" class="form-control" >
                </div>
         </div>
     </div>
     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Imagem do produto:</strong>
                <input type="file" id="image" name="image" class="form-control" >
                </div>
         </div>
     </div>

     <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Tipos:</strong>
                    <select class="custom-select" name="tipos_id[]" multiple>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                        @endforeach    
                    </select>
                </div>
         </div>
     </div>


     <div class="row">
        <div class="col text-center">
                
                <button type="submit" class="btn col btn-primary">CREATE</button>
                
         </div>
     </div>

     

</form>


@endsection