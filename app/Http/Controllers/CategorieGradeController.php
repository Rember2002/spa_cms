<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategorieGradeResource;
use App\Models\CategorieGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class CategorieGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return  CategorieGradeResource::collection(CategorieGrade::
        select('categorie_grades.id', 'categorie_grades.name_categorie', 'categorie_grades.description', 'categorie_grades.id_grade', 'grades.name_grade')
        ->join('grades', 'categorie_grades.id_grade', '=', 'grades.id')
        ->get());
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
        return (new CategorieGradeResource(CategorieGrade::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorieGrade  $categorieGrade
     * @return \Illuminate\Http\Response
     */
    public function show($categorieGrade)
    {
        return  CategorieGradeResource::collection(CategorieGrade::
        select('categorie_grades.id', 'categorie_grades.name_categorie', 'categorie_grades.description', 'categorie_grades.id_grade', 'grades.name_grade')
            ->join('grades', 'categorie_grades.id_grade', '=', 'grades.id')
            ->where('grades.id',$categorieGrade)
            ->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorieGrade  $categorieGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorieGrade $categorieGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorieGrade  $categorieGrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorieGrade $categorieGrade)
    {
        $categorieGrade->update($request->all());

        return (new CategorieGradeResource($categorieGrade))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieGrade  $categorieGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorieGrade $categorieGrade)
    {
        $categorieGrade->delete();

        return (new CategorieGradeResource($categorieGrade))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
