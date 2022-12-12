        
        
        <h1>{{ $modo }} Mesa</h1>
<div class="form-group">
        <label for="nombre">Numero mesa</label>
        <input type="nombre" class="form-control" name="nombre" value="{{   isset($mesa->nombre)? $mesa->nombre:old('nombre') }}" id="nombre">
        
</div>
<div class="form-group">
        <label for="imagen"></label>
        @if(isset($mesa->imagen))
        
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$mesa->imagen }}" width="100" alt="">
        @endif
        
        <input type="file" class="form-control" name="imagen" value='' id="imagen">
        
</div>
        
        <input class="btn btn-success" type="submit" value="{{ $modo }} datos ">

        <a class="btn btn-primary" href="{{ url('/mesas/lista') }}">Cancelar</a>