<?php

namespace App\Http\Controllers\ApiControllers;

use App\ApiModelos\es;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class esController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $es = es::with(['autoriza','salida','producto'])->where('status','=','0')->get();
        return $es;
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
        $es = new es();
        $es->autorizado_id = $request->autorizado_id;
        $es->salida_id = $request->salida_id;
        $es->cantidad = $request->cantidad;
        $es->status = $request->status;
        $es->producto_id  = $request->producto_id;
        $es->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $es = es::with(['autoriza','salida','producto'])->where('id','=',$id)->get();
        return $es;
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
        $es =  es::findOrFail($id);
        $es->autorizado_id = $request->autorizado_id;
        $es->salida_id = $request->salida_id;
        $es->cantidad = $request->cantidad;
        $es->status = $request->status;
        $es->producto_id  = $request->producto_id;
        $es->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $es = es::destroy($id);
        return $es;
    }
}
