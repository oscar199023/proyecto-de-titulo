<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Storage;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('producto.pedido');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function lista()
    {
        $datos['pedidos']=Pedido::orderBy('id', 'DESC')->paginate()->all();
        return view('producto.pedido', $datos);
    }

    public function create()
    {
        return view('formulario.crearPedido');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //quiere decir que quite el campo nombre
        $pedidosProducto = request()->except('_token');

        //si existe una imagen
        if($request->hasFile('imagen')){
            //alteramos el campo---- utilizamos el nombre de ese campo---luego lo insertamos    
            $pedidosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }

        Pedido::insert($pedidosProducto);
        
        return redirect('/pedidos/lista')->with('mensaje', 'pedido agregado con exito ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('formulario.editarPedido', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pedidosProducto = request()->except(['_token', '_method']);

        //si hay foto 
        if($request->hasFile('imagen')){
            //agarra esa foto 
            $mesa = Pedido::findOrFail($id);
            // y eliminala de la carpeta
            Storage::delete('public/'.$pedido->imagen);
            //alteramos el campo---- utilizamos el nombre de ese campo---luego lo insertamos    
            $pedidosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }


        //vas a buscar la informacion que esta con el id y vas a buscar el id que te paso
        //para acutualizar el id
        Pedido::where('id', '=', $id)->update($pedidosProducto);

        $pedido = Pedido::findOrFail($id);
        //return view('formulario.editarPedido', compact('pedido'));
        return redirect('/pedidos/lista')->with('mensaje','pedido modificado con exito ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        if(Storage::delete('public/'.$pedido->imagen)){

            Pedido::destroy($id);
        }

        
        return redirect('/pedidos/lista')->with('mensaje','pedido Borrado con exito ');
    }
}
