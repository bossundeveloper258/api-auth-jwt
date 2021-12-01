<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Constants;
use Exception;

class DepartmentController extends Controller
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
            $departments = Department::where("status", "=" , Constants::ACTIVE)->get()->sortByDesc('created_at');
            return (new DepartmentResourceCollection($departments))->response();
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:150',
        ]);

        try {
            $department = new Department();
            $department->name = $request->input('name');
            $department->status = true;

            $department->save();

            Log::info("Department ID {$department->id} created successfully.");

            return (new DepartmentResource($department))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }

    }

    public function show($id)
    {
        //
        try {

            $department = Department::find($id);
            return response()->json($department, Response::HTTP_OK);

        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:150',
        ]);

        try {
            $department = Department::find($id);
            $department->name = $request->input('name');

            $department->save();

            Log::info("Department ID {$department->id} updated successfully.");

            return response()->json(array("message" => "OK"), Response::HTTP_OK); 
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $department = Department::find($id);
            $department->status = Constants::DESACTIVE;

            $department->save();

            Log::info("Department ID {$department->id} updated successfully.");

            return response()->json(array("message" => "OK"), Response::HTTP_OK); 
        } catch (Exception $e) {
            return response()->json(array("message" => "error"), Response::HTTP_NOT_FOUND);
        }
    }
}
