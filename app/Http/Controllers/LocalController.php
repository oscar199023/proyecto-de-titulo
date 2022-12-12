<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Storage;
use Illuminate\Support\Facades\Auth;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('producto.local');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function lista()
    {
        $datos['local']=Local::orderBy('id', 'DESC')->paginate()->all();
        return view('producto.local', $datos);
    }



    public function create()
    {
        return view('formulario.crearLocal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validaciones de campos
        $campos=[
            'nombre'=>'required|string',
            'razon_social'=>'required|string',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required|email'
        ];
        //mensaje de validacion
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'imagen.required'=>'La Imagen es requerida'
        ];

            //unimos los campos de validacion
        $this->validate($request, $campos, $mensaje);


        //quiere decir que quite el campo nombre
        $localProducto = request()->except('_token');

        Local::insert($localProducto);
        
        return redirect('/local/lista')->with('mensaje', 'local agregado con exito ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $local = Local::findOrFail($id);
        return view('formulario.editarLocal', compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


         //validaciones de campos
         $campos=[
            'nombre'=>'required|string',
            'razon_social'=>'required|string',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required|email'
        ];
        //mensaje de validacion
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'imagen.required'=>'La Imagen es requerida'
        ];

            //unimos los campos de validacion
        $this->validate($request, $campos, $mensaje);




           //sube los todos los datos menos el token y el method
           $localProducto = request()->except(['_token', '_method']);

           //vas a buscar la informacion que esta con el id y vas a buscar el id que te paso
         //para acutualizar el id
         Local::where('id', '=', $id)->update($localProducto);
 
         $local = Local::findOrFail($id);
         //return view('formulario.editarLocal', compact('local'));
         return redirect('/local/lista')->with('mensaje','Local modificado con exito ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        Local::destroy($id);
        
        return redirect('/local/lista')->with('mensaje','Local Borrado con exito ');
    }
}
