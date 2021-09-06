<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStudentCouncilRequest;
use App\Http\Requests\UpdateStudentCouncilRequest;
use App\Http\Resources\StudentCouncilResource;
use App\Models\Commission;
use App\Models\StudentCouncil;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StudentCouncilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return StudentCouncilResource::collection(StudentCouncil::all());
    
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
    public function store(SaveStudentCouncilRequest $request, StudentCouncil $studentCouncil)
    {
        $studentCouncil->year = $request->year;
        $path = $request->file('image')->store('images_studentcouncil');
        $studentCouncil->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $studentCouncil->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentCouncil  $studentCouncil
     * @return \Illuminate\Http\Response
     */
    public function show(StudentCouncil $studentCouncil)
    {

        return new StudentCouncilResource($studentCouncil);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentCouncil  $studentCouncil
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCouncil $studentCouncil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentCouncil  $studentCouncil
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentCouncilRequest $request, StudentCouncil $studentCouncil)
    {
        $studentCouncil->year = $request->year;
        $oldPath = $studentCouncil->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_studentcouncil');
            $studentCouncil->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $studentCouncil->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentCouncil  $studentCouncil
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCouncil $studentCouncil)
    {
        if ($studentCouncil->delete()){
            Storage::delete($studentCouncil->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $studentCouncil,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $studentCouncil,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
