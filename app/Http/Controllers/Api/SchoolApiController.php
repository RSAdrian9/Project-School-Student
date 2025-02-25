<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Se obtienen las escuelas paginadas (se añadió la paginación, de forma opcional)
        $schools = School::paginate(10);
        return SchoolResource::collection($schools);
    }

    public function indexById($id)
    {
        // Se obtiene la escuela por su id
        $school = School::find($id);
        return new SchoolResource($school);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
        $request->validate(['name' => 'required', 'city' => 'required']);
        $school = School::create($request->all());
        return response()->json(new SchoolResource($school), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $school = School::findOrFail($id); // Se obtiene la escuela por su id y se lanza una excepción si no se encuentra
        return new SchoolResource($school);
        //return $school; // Se retorna el instituto sin formato
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        //
        $request->validate([
            'name' => 'sometimes|required',
            'city' => 'sometimes|required',
        ]);
        $school->update($request->all());
        return new SchoolResource($school);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        //
        $school->delete();
        return response()->json(['message' => 'School deleted successfully'], 200);
    }
}
