<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveGradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GradeResource::collection(DB::
        select('SELECT g.id, g.name_grade, g.description, g.image, g.id_academic_offer, a.name_offer 
        FROM grades g INNER JOIN academic_offers a ON g.id_academic_offer = a.id'));
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
    public function store(SaveGradeRequest $request, Grade $grade)
    {
        $grade->name_grade = $request->name_grade;
        $grade->description = $request->description;
        $grade->id_academic_offer = $request->id_academic_offer;
        $path = $request->file('image')->store('images_grades');
        $grade->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $grade->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {

        return new GradeResource($grade);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $grade->name_grade = $request->name_grade;
        $grade->description = $request->description;
        $grade->id_academic_offer = $request->id_academic_offer;
        $oldPath = $grade->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_grades');
            $grade->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $grade->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        if ($grade->delete()){
            Storage::delete($grade->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $grade,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $grade,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
