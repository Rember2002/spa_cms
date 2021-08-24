<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveIntegrantRequest;
use App\Http\Resources\IntegrantResource;
use App\Models\Integrant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IntegrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $integrant = IntegrantResource::collection(Integrant::all());

        return response()->json([

            "data" => $integrant,
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
    public function store(SaveIntegrantRequest $request)
    {
        $integrant = Integrant::create($request->all());
        
        return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $integrant,
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function show(Integrant $integrant)
    {
        return response()->json([

            "data" =>  $integrant,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function edit(Integrant $integrant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function update(SaveIntegrantRequest $request, Integrant $integrant)
    {
        $integrant->update($request->all());
        
        return response()->json([

            "message" => "El registro ha sido modificado con ¡Exito!",
            "data" =>  $integrant,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Integrant $integrant)
    {
        $integrant->delete();
        
        return response()->json([

            "message" => "El registro se ha eliminado con ¡Exito!",
            "data" => $integrant,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }
}
