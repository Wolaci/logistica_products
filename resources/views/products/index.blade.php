@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Produtos</h2>
        </div>
    </div>
</div>

@if (session('success'))
  <div class="alert alert-success">
    {{ session('success')}}
  </div>
@endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Título</th>
    </tr>
  </thead>

  
  <tbody>
    @foreach($products as $product)

    <tr>
      <th scope="row">{{$product->id}}</th>
      <td>
      <a href="{{ url("/products/{$product->id}") }}">
        {{$product->title}}
      </a>
      </td>

      <td>
      <form action="{{route('products.destroy', $product->id)}}" method="POST">
        <a class="btn btn-info" href="{{route('products.show', $product->id)}}">Visualizar
        </a>
        <a class="btn btn-info" href="{{route('products.edit', $product->id)}}">Editar
        </a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>

      </form>
      </td>
    
    
    </tr>
    @endforeach
    
  </tbody>
</table>

{{$products->links()}}


@endsection