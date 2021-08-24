<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSalesianExperienceRequest;
use App\Http\Resources\SalesianExperienceResource;
use App\Models\SalesianExperience;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SalesianExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $salesianExperience = SalesianExperienceResource::collection(SalesianExperience::all());

        // return response()->json([

        //     "data" => $salesianExperience,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return SalesianExperienceResource::collection(SalesianExperience::all());
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
    public function store(SaveSalesianExperienceRequest $request)
    {
        // $salesianExperience = SalesianExperience::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $salesianExperience,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        return (new SalesianExperienceResource(SalesianExperience::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesianExperience  $salesianExperience
     * @return \Illuminate\Http\Response
     */
    public function show(SalesianExperience $salesianExperience)
    {
        // return response()->json([

        //     "data" => $salesianExperience,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return new SalesianExperienceResource($salesianExperience);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesianExperience  $salesianExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesianExperience $salesianExperience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesianExperience  $salesianExperience
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSalesianExperienceRequest $request, SalesianExperience $salesianExperience)
    {
        // $salesianExperience->update($request->all());
       
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $salesianExperience,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $salesianExperience->update($request->all());

        return (new SalesianExperienceResource($salesianExperience))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesianExperience  $salesianExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesianExperience $salesianExperience)
    {
        // $salesianExperience->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $salesianExperience,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return (new SalesianExperienceResource($salesianExperience))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
