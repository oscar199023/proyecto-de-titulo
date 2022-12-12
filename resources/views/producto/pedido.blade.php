@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>{{ Auth::user()->name }}</strong> 
{{Session::get('mensaje')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        
    </button>
<!--<h1>estas en administrador vista {{ Auth::user()->name }}</h1>-->
</div>
@endif

<a class="btn btn-success" href="{{ url('/pedidos/create') }}">Registrar nuevo producto </a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>          <td>Imagen</td>
            <td>Iva</td>
            <td>Proponia</td>
            <td>Subtotal</td>
            <td>Total</td>
            <td>Acciones</td>
            
        </tr>
    </thead>
    <tbody>
        @foreach( $pedidos as $pedido)
        <tr>
          

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$pedido->imagen }}" width="100" height="50" alt="">
            </td>

            <td>{{ $pedido->iva }}</td>
            <td>{{ $pedido->propina }}</td>
            <td>{{ $pedido->subTotal }}</td>
            <td>{{ $pedido->total }}</td>


            <td>
                <!--editar-->
                <a class="btn btn-warning" class="d-iline" href="{{ url( '/pedidos/'.$pedido->id.'/edit' ) }}">editar</a>
                
                <!--borrar-->
                <form action="{{ url('/pedidos/'.$pedido->id) }}" class="d-inline" method="post">
                    @csrf 
                    {{ method_field('DELETE')}}
                    <input class="btn btn-danger" type="submit" onclick="return confirm(' ¿Quieres borrar?')" value="Borrar">
                </form>
            </td>
        
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection