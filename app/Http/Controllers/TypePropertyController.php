<?php

namespace App\Http\Controllers;

use App\Models\TypeProperty;
use Illuminate\Http\Request;
use App\Http\Resources\TypePropertyResource;
use App\Http\Resources\TypePropertyResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Constants;
use Exception;

class TypePropertyController extends Controller
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
            $typeProperties = TypeProperty::where("status", "=" , Constants::ACTIVE)->get()->sortByDesc('created_at');
            return (new TypePropertyResourceCollection($typeProperties))->response();
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
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

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        try {
            
            $typeProperty = new TypeProperty();
    
            $typeProperty->name = $request->input('name');
            $typeProperty->status = Constants::ACTIVE;
    
            $typeProperty->save();
    
            Log::info("TypeProperty ID {$typeProperty->id} created successfully.");
    
            return (new TypePropertyResource($typeProperty))->response()->setStatusCode(Response::HTTP_CREATED);

        } catch (Exception $e) {

            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    public function show($id)
    {
        //
        $typeProperty = TypeProperty::find($id);
        return response()->json($typeProperty, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeProperty  $typeProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeProperty $typeProperty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeProperty  $typeProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        try {
            $typeProperty = TypeProperty::find($id);

            $typeProperty->name = $request->input('name');
    
            $typeProperty->save();
    
            Log::info("TypeProperty ID {$typeProperty->id} update successfully.");
    
            return response()->json(array("message" => "OK"), Response::OK); 

        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeProperty  $typeProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $typeProperty = TypeProperty::find($id);

            $typeProperty->status = Constants::DESACTIVE;

            $typeProperty->save();

            return response()->json(array("message" => "OK"), Response::OK);
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }

    }
}
