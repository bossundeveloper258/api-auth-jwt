<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Resources\SessionResource;
use App\Http\Resources\SessionResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Constants;
use Exception;

class SessionController extends Controller
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

            $session = Session::all()->sortByDesc('created_at');
            return (new SessionResourceCollection($session))->response();

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
        $request->validate([
            'id_user' => 'required',
            // 'session_at' => 'required',
            'token' => 'required',
            'device' => 'required',
        ]);

        try {
            $session = new Session();
            $session->id_user = $request->input('id_user');
            $session->session_at = date('Y-m-d H:i:s'); 
            $session->token = $request->input('token'); 
            $session->device = $request->input('device'); 
            
            $session->save();

            Log::info("Session ID {$session->id} created successfully.");

            return (new SessionResource($session))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
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
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $session = Session::with('user')->find($id);
            return response()->json($session, 200);
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
