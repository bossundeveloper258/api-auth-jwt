<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Constants;
use Exception;

class PersonController extends Controller
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
            $persons = Person::where("status", "=" , Constants::ACTIVE)->get()->sortByDesc('created_at');
            return (new PersonResourceCollection($persons))->response();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $person = Person::with('type_person')->find($id);
        return response()->json($person, 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'nuip' => 'required',
            "phone" => 'required',
            "id_city" => 'required',
            "id_type_person" => 'required',
        ]);
        

        try {
            $person = Person::find($id);

            $person->name = $request->input('name');
            $person->lastname = $request->input('lastname');
            $person->email = $request->input('email');
            $person->nuip = $request->input('nuip');
            $person->phone = $request->input('phone');
            $person->id_city = $request->input('id_city');
            $person->id_type_person = $request->input('id_type_person');

            $person->save();

            Log::info("Person ID {$person->id} updated successfully.");

            return response()->json(array("message" => "OK"), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try {
            $person = Person::find($id);

            $person->status = Constants::DESACTIVE;

            $person->save();

            Log::info("Person ID {$person->id} updated successfully.");

            return response()->json(array("message" => "OK"), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
    }
}
