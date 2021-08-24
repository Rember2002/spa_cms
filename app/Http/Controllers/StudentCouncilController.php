<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStudentCouncilRequest;
use App\Http\Resources\StudentCouncilResource;
use App\Models\Commission;
use App\Models\StudentCouncil;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentCouncilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Commission $commission)
    {
        // $studentCouncil = StudentCouncil::findOrFail($commission->id);

        // return response()->json([

        //     "data" => $studentCouncil,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return StudentCouncilResource::collection(StudentCouncil::findOrFail($commission->id));
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
    public function store(SaveStudentCouncilRequest $request)
    {
        // $studentCouncil = StudentCouncil::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $studentCouncil,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        return (new StudentCouncilResource(StudentCouncil::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentCouncil  $studentCouncil
     * @return \Illuminate\Http\Response
     */
    public function show(StudentCouncil $studentCouncil)
    {
        // return response()->json([

        //     "data" =>  $studentCouncil,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

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
    public function update(SaveStudentCouncilRequest $request, StudentCouncil $studentCouncil)
    {
        // $studentCouncil->update($request->all());
        
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" =>  $studentCouncil,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $studentCouncil->update($request->all());

        return (new StudentCouncilResource($studentCouncil))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentCouncil  $studentCouncil
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCouncil $studentCouncil)
    {
        // $studentCouncil->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $studentCouncil,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return (new StudentCouncilResource($studentCouncil))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
