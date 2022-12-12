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

<a class="btn btn-success" href="{{ url('/local/create') }}">Registrar nuevo producto </a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>

            <td>Nombre</td>
            <td>Razon social</td>
            <td>Dirección</td>
            <td>Numero de telofono</td>
            <td>Correo</td>
            
        </tr>
    </thead>
    <tbody>
        @foreach( $local as $local)
        <tr>
            
            <td>{{ $local->nombre }}</td>
            <td>{{ $local->razon_social }}</td>
            <td>{{ $local->direccion }}</td>
            <td>{{ $local->telefono }}</td>
            <td>{{ $local->correo }}</td>

            


            <td>
                <!--editar-->
                <a class="btn btn-warning" href="{{ url( '/local/'.$local->id.'/edit' ) }}">editar</a>
                
                <!--borrar-->
                <form action="{{ url('/local/'.$local->id) }}" class="d-inline" method="post">
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