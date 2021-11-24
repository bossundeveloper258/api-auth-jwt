<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Resources\CityResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::all()->sortByDesc('created_at');
        return (new CityResourceCollection($cities))->response();
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
            'name' => 'required|string|max:255',
            'id_department' => 'required',
        ]);

        $city = new City();
        $city->name = $request->input('name');
        $city->id_department = $request->input('id_department'); 
        $city->status = true;

        $city->save();

        Log::info("City ID {$city->id} created successfully.");

        return (new CityResource($city))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
        return response()->json(new CityResource($city), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //

        $request->validate([
            'name' => 'required|string|max:255',
            'id_department' => 'required',
        ]);

        $city->name = $request->input('name');
        $city->id_department = $request->input('id_department'); 
        
        $city->save();

        Log::info("City ID {$city->id} updated successfully.");

        return (new CityResource($city))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
