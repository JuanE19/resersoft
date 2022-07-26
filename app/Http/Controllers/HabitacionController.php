<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Tipo;

class HabitacionController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return 'Vista index ()';
        $habitaciones = Habitacion::all();
        $tipo = Tipo::all();
        return view ('habitacion.index', compact('habitaciones', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *zy
     */
    public function create()
    {
        $tipo = Tipo::all();
        return view ('habitacion.create')->with('tipo', $tipo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try { 
            
                $caracteristicas = "";

            for ($i=1; $i < 12; $i++) { 
                if (isset($_POST[$i])) {
                    $caracteristicas = $caracteristicas."".$_POST[$i].", ";
                   }
            }
            $numero=strlen($caracteristicas);


            if ($caracteristicas == "") {
                return redirect('/habitaciones')->with('error', 'Debes agregar alguna característica');
            }

            else {
                $habitaciones = new Habitacion();
    
            $habitaciones->id = $request->get('id');
            $habitaciones->caracteristicas = $caracteristicas;
            $habitaciones->numerodehabitacion = $request->get('numerodehabitacion');
            $habitaciones->precio = $request->get('precio');
            $habitaciones->tipodehabitacion = $request->get('tipodehabitacion');
    
            $habitaciones->save();
            
    
            return redirect('/habitaciones')->with('message', 'La habitación ha sido registrada exitosamente');
            }
    
           
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                return redirect('/habitaciones')->with('error', 'El número de habitación ya existe');
            } else {
                throw $th;
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo = Tipo::all();
        $habitacion = Habitacion::find($id);
        return view('habitacion.edit', compact("tipo", "habitacion"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $caracteristicas = "";

            for ($i=1; $i < 12; $i++) { 
                if (isset($_POST[$i])) {
                    $caracteristicas = $caracteristicas."".$_POST[$i].", ";
                   }
            }
            if ($caracteristicas == "") {
                return redirect('/habitaciones')->with('error', 'Debes agregar alguna característica');
            }

            else {
            
            $habitacion = Habitacion::find($id);
    
    
            $habitacion->caracteristicas = $caracteristicas;
            $habitacion->numerodehabitacion = $request->get('numeroDeHabitacion');
            $habitacion->precio = $request->get('precio');
            $habitacion->tipodehabitacion = $request->get('tipodehabitacion');
            
            $habitacion->save();
    
            return redirect('/habitaciones')->with('message','La habitacion se ha actualizado correctamente');

            }
            
            
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                return redirect('/habitaciones')->with('error', 'El número de habitación ya existe');
            } else {
                throw $th;
            }
        }

    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::find($id);        
        $habitacion->delete();
        return redirect ('/habitaciones')->with('message','La habitación se ha eliminado correctamente');
    }
    public function actualizarestado(Habitacion $habitacion){ 

        if($habitacion->estado==1)
            $habitacion->estado=0;
        else        
            $habitacion->estado=1;
        $habitacion->update();

        return redirect('/habitaciones')->with('message', 'Estado cambiado');
    }
   
}
