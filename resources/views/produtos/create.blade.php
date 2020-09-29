@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create a new Product</h2>
        </div>
    </div>
</div>

<form action="{{ route('produtos.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col">
                <div class="form-group">
                <strong>Título:</strong>
                <input type="text" name="titulo" class="form-control">
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