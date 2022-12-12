
        <h1>{{ $modo }} Local</h1>

        @if(count($errors)>0)

<div class=" alert alert-danger" role="alert">
  <ul>
          @foreach( $errors->all() as $error)
                  <li>{{ $error }}</li>
          @endforeach
  </ul>

@endif



<div class="form-group">
        <label for="nombre">Nombre Local</label>
        <input type="nombre" class="form-control" name="nombre" value="{{   isset($local->nombre)? $local->nombre:old('nombre') }}" id="nombre">
        
</div>
<div class="form-group">
        <label for="razon social">Razon social</label>
        <input type="nombre" class="form-control" name="razon social" value="{{   isset($local->razon_social)? $local->razon_social:old('razon social') }}" id="razon_social">
        
</div>
<div class="form-group">
        <label for="direccion">Direccion</label>
        <input type="nombre" class="form-control" name="direccion" value="{{   isset($local->direccion)? $local->direccion:old('direccion') }}" id="direccion">
        
</div>
<div class="form-group">
        <label for="telefono">Numero de telefono</label>
        <input type="nombre" class="form-control" name="telefono" value="{{   isset($local->telefono)? $local->telefono:old('telefono') }}" id="telefono">
        
</div>
<div class="form-group">
        <label for="correo">Correo</label>
        <input type="nombre" class="form-control" name="correo" value="{{   isset($local->correo)? $local->correo:old('correo')}}" id="correo">
        
</div>
        <input class="btn btn-success" type="submit" value="{{ $modo }} datos ">
        
        <a class="btn btn-primary" href="{{ url('/local/lista') }}">Cancelar</a>