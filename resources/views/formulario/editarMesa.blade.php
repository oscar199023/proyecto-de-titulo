
@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{{ url('/mesas/'.$mesa->id )}}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('formulario.formMesa', ['modo'=>'Editar'])
    </form>
</div>
@endsection