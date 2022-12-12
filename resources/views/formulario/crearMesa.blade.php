@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('/mesas') }}" method="post" enctype="multipart/form-data">
    @csrf 
    @include('formulario.formMesa', ['modo'=>'Crear'])
    </form>
</div>
@endsection