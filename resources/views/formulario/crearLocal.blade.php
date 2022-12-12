@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('/local') }}" method="post" enctype="multipart/form-data">
    @csrf 
    @include('formulario.formLocal', ['modo'=>'Crear'])
    </form>
</div>
@endsection