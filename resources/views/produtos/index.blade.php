@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>produto</h2>
        </div>
    </div>
</div>





<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Título</th>
    </tr>
  </thead>

  
  <tbody>
    @foreach($produtos as $product)

    <tr>
      <th scope="row">{{$product->id}}</th>
      <td>
      <a href="{{ url("/produtos/{$product->id}") }}">
        {{$product->titulo}}
      </a>
      
      </td>

      <td>
      <form action="{{route('produtos.destroy', $product->id)}}" method="POST">
        <a class="btn btn-info" href="{{route('produtos.show', $product->id)}}">Visualizar
        </a>
        <a class="btn btn-info" href="{{route('produtos.edit', $product->id)}}">Editar
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




@endsection