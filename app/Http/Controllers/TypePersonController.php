<?php

namespace App\Http\Controllers;

use App\Models\TypePerson;
use Illuminate\Http\Request;
use App\Http\Resources\TypePersonResource;
use App\Http\Resources\TypePersonResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Constants;
use Exception;

class TypePersonController extends Controller
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

            $typepersons = TypeProperty::where("status", "=" , Constants::ACTIVE)->get()->sortByDesc('created_at');
            return (new TypePersonResourceCollection($typepersons))->response();

        } catch (Exception $e) {

            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {

            $typeperson = TypePerson::find($id);
            return response()->json($typeperson, 200);

        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'description' => 'required|string|max:200',
        ]);

        try {

            $typeperson = new TypePerson();

            $typeperson->description = $request->input('description');
            $typeperson->status = Constants::ACTIVE;

            $typeperson->save();

            Log::info("TypePerson ID {$typeperson->id} created successfully.");

            return (new TypePersonResource($typeperson))->response()->setStatusCode(Response::HTTP_CREATED);

        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'description' => 'required|string|max:200',
        ]);

        try {
            $typeperson = TypePerson::find($id);

            $typeperson->description = $request->input('description');

            $typeperson->save();

            Log::info("TypePerson ID {$typeperson->id} created successfully.");

            return response()->json(array("message" => "OK"),  Response::OK); 

        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypePerson  $typePerson
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {

            $typeperson = TypePerson::find($id);

            $typeperson->status = Constants::DESACTIVE;

            return response()->json(array("message" => "OK"), Response::OK); 

        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }
}
