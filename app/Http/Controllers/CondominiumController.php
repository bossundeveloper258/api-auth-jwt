<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Resources\CondominiumResource;
use App\Http\Resources\CondominiumResourceCollection;

class CondominiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $condominium = Condominium::all()->sortByDesc('created_at');
        return (new CondominiumResourceCollection($condominium))->response();
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
        //
        $request->validate([
            'id_city' => 'required',
            'id_type_property' => 'required',
            'name' => 'required|max:200',
            'address' => 'required|max:150',
            'neighborhood' => 'required|max:200',
        ]);

        $condominium = new Condominium();
        $condominium->name = $request->input('name');
        $condominium->address = $request->input('address'); 
        $condominium->neighborhood = $request->input('neighborhood');
        $condominium->id_city = $request->input('id_city');
        $condominium->id_type_property = $request->input('id_type_property');

        $condominium->save();

        Log::info("City ID {$condominium->id} created successfully.");

        return (new CondominiumResource($condominium))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function show(Condominium $condominium)
    {
        //
        return response()->json(new CondominiumResource($condominium), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function edit(Condominium $condominium)
    {
        //

        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Condominium $condominium)
    {
        //
        $request->validate([
            'id_city' => 'required',
            'id_type_property' => 'required',
            'name' => 'required|max:200',
            'address' => 'required|max:150',
            'neighborhood' => 'required|max:200',
        ]);

        $condominium->name = $request->input('name');
        $condominium->address = $request->input('address'); 
        $condominium->neighborhood = $request->input('neighborhood');
        $condominium->id_city = $request->input('id_city');
        $condominium->id_type_property = $request->input('id_type_property');

        $condominium->save();

        Log::info("Condominium ID {$condominium->id} updated successfully.");

        return (new CondominiumResource($condominium))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condominium $condominium)
    {
        //
    }
}
