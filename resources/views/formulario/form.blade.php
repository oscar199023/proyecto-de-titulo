      
        <h1>{{ $modo }} Producto</h1>

@if(count($errors)>0)

      <div class=" alert alert-danger" role="alert">
        <ul>
                @foreach( $errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
        </ul>

@endif


<div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="nombre" class="form-control" name="nombre" value="{{   isset($producto->nombre)? $producto->nombre:old('nombre') }}" id="nombre">
        
</div>
<div class="form-group">
        <label for="precio">Precio</label>
        <input type="precio" class="form-control" name="precio" value="{{ isset($producto->precio)? $producto->precio:old('precio') }}" id="precio">
        
</div>
<div class="form-group">
        <label for="categoria">Categoria</label>
        <!--<input type="categoria" class="form-control" name="categoria" value="{{ isset($producto->categoria)? $producto->categoria:old('categoria') }}" id="categoria">-->
        <select class="form-select" aria-label="Default" name="categoria">
        <option selected>Selecciona categoria</option>
        <option value="1">Bebidas</option>
        <option value="2">Bebidas alcholicas</option>
        <option value="3">Plato de fondo</option>
        <option value="4">Ensaldas</option>
        <option value="5">Postres</option>
</select>
        
</div>
<div class="form-group">
        <label  for="imagen"></label>
        @if(isset($producto->imagen))
        
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$producto->imagen }}" width="100" alt="">
        @endif
        

        <input  type="file" class="form-control" name="imagen" value=''  id="imagen">
        
</div>
        <input class="btn btn-success" type="submit" value="{{ $modo }} producto" >

        <a class="btn btn-primary" href="{{ url('/home') }}">Cancelar</a>
