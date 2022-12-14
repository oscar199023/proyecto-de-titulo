<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;
//incluimos la clase que contiene varios elemtos para poder borrar
use Illuminate\Support\facades\Storage;
use Illuminate\Support\Facades\Auth;
class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('producto.administrador');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function lista(Request $request)
    {
        $key = $request->key;
        $datos['productos'] = null;
        if($key){
            
            $datos['productos']=producto::select('*')->where('categoria', '=',  $key )->orderBy('id', 'DESC')->paginate('100');
        }
        else{
            $datos['productos']=producto::select('*')->orderBy('id', 'DESC')->paginate('100');
        }
        
        return view('producto.administrador', $datos);
        
    }

   


    public function create()
    {
        return view('formulario.crearProducto');  
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
            'precio'=>'required|integer',
            'categoria'=>'required',
            'imagen'=>'required',
        ];
        //mensaje de validacion
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'imagen.required'=>'La Imagen es requerida'
        ];

            //unimos los campos de validacion
        $this->validate($request, $campos, $mensaje);

        //quiere decir que quite el campo nombre
        $datosProducto = request()->except('_token');

        //si existe una imagen
        if($request->hasFile('imagen')){
            //alteramos el campo---- utilizamos el nombre de ese campo---luego lo insertamos    
            $datosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }

        producto::insert($datosProducto);
        //return response()->json($datosProducto);
        // esta redireccioanando a la vista y escribira un mensaje.
        return redirect('/home')->with('mensaje', 'Producto agregado con exito ');
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $producto = producto::findOrFail($id);
        return view('formulario.editarProducto', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


         //validaciones de campos
         $campos=[
            'nombre'=>'required|string',
            'precio'=>'required|integer',
            'categoria' => 'required',
            
        ];
      
        //mensaje de validacion
        $mensaje=[
            'required'=>'El :attribute es requerido',
            
        ];

        if($request->hasFile('imagen')){
            $campos=['imagen'=>'required'];
            $mensaje=['imagen.required'=>'La Imagen es requerida'];

        }
        
            //unimos los campos de validacion
        $this->validate($request, $campos, $mensaje);


        //sube los todos los datos menos el token y el method
        $datosProducto = request()->except(['_token', '_method']);

        //si hay foto 
        if($request->hasFile('imagen')){
            //agarra esa foto 
            $producto = producto::findOrFail($id);
            // y eliminala de la carpeta
            Storage::delete('public/'.$producto->imagen);
            //alteramos el campo---- utilizamos el nombre de ese campo---luego lo insertamos    
            $datosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }


        //vas a buscar la informacion que esta con el id y vas a buscar el id que te paso
        //para acutualizar el id
        producto::where('id', '=', $id)->update($datosProducto);

        $producto = producto::findOrFail($id);
        //return view('formulario.editarProducto', compact('producto'));
        return redirect('/home')->with('mensaje','Producto modificado con exito ');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = producto::findOrFail($id);
        
        if(Storage::delete('public/'.$producto->imagen)){

            producto::destroy($id);
        }

        
        return redirect('/home')->with('mensaje','Producto Borrado con exito ');
    }
}
