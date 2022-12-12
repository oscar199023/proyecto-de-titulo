@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('/local/'.$local->id )}}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('formulario.formLocal', ['modo'=>'Editar'])
    </form>
</div>
@endsection