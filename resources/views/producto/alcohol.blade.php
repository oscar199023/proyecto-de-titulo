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




<a class="btn btn-success" href="{{ url('/producto/create') }}">Registrar nuevo producto </a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            
            <td>Imagen</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>acciones</td>
            
        </tr>
    </thead>
    <tbody>
        @foreach( $productos as $producto)
        <tr>
            
        @if($producto->categoria == 2)

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$producto->imagen }}" width="100" height="50" alt="">
            </td>

            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->precio }}</td>
        


            <td>
                <!--editar-->
                <a class="btn btn-warning"  href="{{ url( '/producto/'.$producto->id.'/edit' ) }}">editar</a>
                
                <!--borrar-->
                <form action="{{ url('/producto/'.$producto->id) }}" class="d-inline" method="post">
                    @csrf 
                    {{ method_field('DELETE')}}
                    <input class="btn btn-danger" type="submit" onclick="return confirm(' ¿Quieres borrar?')" value="Borrar">
                </form>
            </td>
        @endif
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection