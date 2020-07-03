<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiModelos\productos;
use App\ApiModelos\almacenes;

class productosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = productos::with(['almacenes','subcategoria','ubicacion','unidad','categoria'])->get();
        return $productos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new productos();
        $producto->producto = $request->producto;
        $producto->almacen_id = $request->almacen_id;
        $producto->subcategoria_id = $request->subcategoria_id;
        $producto->ubicacion_id = $request->ubicacion_id;
        $producto->unidad_id = $request->unidad_id;
        $producto->cantidad = $request->cantidad;
        $producto->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = productos::findOrFail($id);
        return $producto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $producto = productos::findOrFail($id);

        $producto->producto = $request->producto;
        $producto->almacen_id = $request->almacen_id;
        $producto->subcategoria_id = $request->subcategoria_id;
        $producto->ubicacion_id = $request->ubicacion_id;
        $producto->unidad_id = $request->unidad_id;
        $producto->cantidad = $request->cantidad;

        $producto->save();
        return $producto;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = productos::destroy($id);
        return $producto;
    }
}
