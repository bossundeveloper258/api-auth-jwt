<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Resources\CityResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Constants;
use Exception;

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
        try {

            $cities = City::where("status", "=" , Constants::ACTIVE)->get()->sortByDesc('created_at');
            return (new CityResourceCollection($cities))->response();

        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'id_department' => 'required',
        ]);

        try {
            $city = new City();
            $city->name = $request->input('name');
            $city->id_department = $request->input('id_department'); 
            $city->status = Constants::ACTIVE;

            $city->save();

            Log::info("City ID {$city->id} created successfully.");

            return (new CityResource($city))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }

        
    }

    public function show($id)
    {
        //
        $city = City::with('departament')->find($id);
        return response()->json($city, 200);
    }

    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'name' => 'required|string|max:255',
            'id_department' => 'required',
        ]);
        try {
            $city = City::find($id);
            $city->name = $request->input('name');
            $city->id_department = $request->input('id_department'); 
            
            $city->save();

            Log::info("City ID {$city->id} updated successfully.");

            return response()->json(array("message" => "OK"), Response::OK); 
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        try {
            $city = City::find($id);
            $city->status = Constants::DESACTIVE;
            $city->save();

            Log::info("City ID {$city->id} updated successfully.");

            return response()->json(array("message" => "OK"), Response::OK); 
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
    }
}
