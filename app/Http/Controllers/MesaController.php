<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Storage;
use Illuminate\Support\Facades\Auth;




class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('producto.mesa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function lista()
    {
        $datos['mesas']=Mesa::orderBy('id', 'DESC')->paginate()->all();
        return view('producto.mesa', $datos);
    }
    
    public function create()
    {
        return view('formulario.crearMesa');
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
         $mesasProducto = request()->except('_token');

         //si existe una imagen
         if($request->hasFile('imagen')){
             //alteramos el campo---- utilizamos el nombre de ese campo---luego lo insertamos    
             $mesasProducto['imagen']=$request->file('imagen')->store('uploads','public');
         }
 
         Mesa::insert($mesasProducto);
         
         return redirect('/mesas/lista')->with('mensaje', 'mesa agregado con exito ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function show(Mesa $mesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mesa = Mesa::findOrFail($id);
        return view('formulario.editarMesa', compact('mesa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //sube los todos los datos menos el token y el method
         $mesasProducto = request()->except(['_token', '_method']);

         //si hay foto 
         if($request->hasFile('imagen')){
             //agarra esa foto 
             $mesa = Mesa::findOrFail($id);
             // y eliminala de la carpeta
             Storage::delete('public/'.$mesa->imagen);
             //alteramos el campo---- utilizamos el nombre de ese campo---luego lo insertamos    
             $mesasProducto['imagen']=$request->file('imagen')->store('uploads','public');
         }
 
 
         //vas a buscar la informacion que esta con el id y vas a buscar el id que te paso
         //para acutualizar el id
         Mesa::where('id', '=', $id)->update($mesasProducto);
 
         $mesa = Mesa::findOrFail($id);
         //return view('formulario.editarMesa', compact('mesa'));
         return redirect('/mesas/lista')->with('mensaje','Mesa modificada con exito ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mesa = Mesa::findOrFail($id);
        
        if(Storage::delete('public/'.$mesa->imagen)){

            Mesa::destroy($id);
        }

        
        return redirect('/mesas/lista')->with('mensaje','Mesa Borrada con exito ');
    }
}
