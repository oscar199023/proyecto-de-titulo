        
        <h1>{{ $modo }} pedidos</h1>
<div class="form-group">
        <label for="iva">Iva</label>
        <input type="nome" class="form-control" name="iva" value="{{   isset($pedido->iva)? $pedido->iva:old('iva')}}" id="iva">
        
</div>
        <label for="imagen"></label>
        @if(isset($pedido->imagen))
        
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$pedido->imagen }}" width="100" alt="">
        @endif
        
        <input type="file" class="form-control" name="imagen" value='' id="imagen">
        
<div class="form-group">
        <label for="propina">Propina</label>
        <input type="number" class="form-control" name="propina" value="{{   isset($pedido->propina)? $pedido->propina:old('propina') }}" id="propina">
        
<div class="form-group">
        <label for="subTotal">subTotal</label>
        <input type="number" class="form-control" name="subTotal" value="{{   isset($pedido->subTotal)? $pedido->subTotal:old('subTotal') }}" id="subTotal">
        
</div>
<div class="form-group">
        <label for="total">Total</label>
        <input type="number" class="form-control" name="total" value="{{   isset($pedido->total)? $pedido->total:old('total')}}" id="total">
        
</div>        
        <input class="btn btn-success" type="submit" value="{{ $modo }} datos ">

        <a class="btn btn-primary" href="{{ url('/pedidos/lista') }}">Cancelar</a>