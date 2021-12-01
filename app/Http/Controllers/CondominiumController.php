<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Resources\CondominiumResource;
use App\Http\Resources\CondominiumResourceCollection;
use App\Constants;
use Exception;
use Illuminate\Support\Facades\Auth;

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

        try {
            //code...
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }

        $condominium = new Condominium();
        $condominium->name = $request->input('name');
        $condominium->address = $request->input('address'); 
        $condominium->neighborhood = $request->input('neighborhood');
        $condominium->id_city = $request->input('id_city');
        $condominium->id_type_property = $request->input('id_type_property');

        $condominium->save();

        $personIds = [Auth()->user->person->id];
        $condominium->persons()->attach($personIds);

        Log::info("City ID {$condominium->id} created successfully.");

        return (new CondominiumResource($condominium))->response()->setStatusCode(Response::HTTP_CREATED);
    }


    public function show($id)
    {
        //
        $condominium = Condominium::find($id);
        return response()->json($condominium, 200);
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'id_city' => 'required',
            'id_type_property' => 'required',
            'name' => 'required|max:200',
            'address' => 'required|max:150',
            'neighborhood' => 'required|max:200',
        ]);
        $condominium = Condominium::find($id);
        $condominium->name = $request->input('name');
        $condominium->address = $request->input('address'); 
        $condominium->neighborhood = $request->input('neighborhood');
        $condominium->id_city = $request->input('id_city');
        $condominium->id_type_property = $request->input('id_type_property');

        $condominium->save();

        Log::info("Condominium ID {$condominium->id} updated successfully.");

        return response()->json(array("message" => "OK"), Response::HTTP_OK);
    }

    public function destroy(Condominium $condominium)
    {
        //
    }
}
