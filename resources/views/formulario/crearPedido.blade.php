@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('/pedidos') }}" method="post" enctype="multipart/form-data">
    @csrf 
    @include('formulario.formPedido', ['modo'=>'Crear'])
    </form>
</div>
@endsection