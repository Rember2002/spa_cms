<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSalesianExperienceHomeRequest;
use App\Models\SalesianExperienceHome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SalesianExperienceHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesianExperienceHome = SalesianExperienceHome::all();

        return response()->json([

            "data" => $salesianExperienceHome,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
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
    public function store(SaveSalesianExperienceHomeRequest $request)
    {
        $salesianExperienceHome = SalesianExperienceHome::create($request->all());
        
        return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $salesianExperienceHome,
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesianExperienceHome  $salesianExperienceHome
     * @return \Illuminate\Http\Response
     */
    public function show(SalesianExperienceHome $salesianExperienceHome)
    {
        return response()->json([

            "data" => $salesianExperienceHome,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesianExperienceHome  $salesianExperienceHome
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesianExperienceHome $salesianExperienceHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesianExperienceHome  $salesianExperienceHome
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSalesianExperienceHomeRequest $request, SalesianExperienceHome $salesianExperienceHome)
    {
        $salesianExperienceHome->update($request->all());
        
        return response()->json([

            "message" => "El registro ha sido modificado con ¡Exito!",
            "data" => $salesianExperienceHome,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesianExperienceHome  $salesianExperienceHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesianExperienceHome $salesianExperienceHome)
    {
        $salesianExperienceHome->delete();
        
        return response()->json([

            "message" => "El registro se ha eliminado con ¡Exito!",
            "data" => $salesianExperienceHome,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }
}
