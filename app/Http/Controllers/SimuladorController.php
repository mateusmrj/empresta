<?php

namespace App\Http\Controllers;

use App\Business\SimuladorBusiness;
use App\Collections\InstituicaoCollection;
use App\Collections\TaxasCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Validator;
use App\Http\Requests\StoreSimuladorRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SimuladorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimuladorRequest $request)
    {
        //dd(;
        $simulador = new SimuladorBusiness();

        $simulacao = $simulador->getSimulacao($request->all());
        //dd($simulacao);
        return $simulacao;

        $collecction  = new TaxasCollection();
        $taxas = $collecction->getTaxasCollection();

        return $taxas->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
