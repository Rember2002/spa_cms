<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStrategicAllieRequest;
use App\Models\StrategicAllie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StrategicAllieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strategicAllie = StrategicAllie::all();

        return response()->json([

            "data" => $strategicAllie,
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
    public function store(SaveStrategicAllieRequest $request)
    {
        $strategicAllie = StrategicAllie::create($request->all());
        
        return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $strategicAllie,
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function show(StrategicAllie $strategicAllie)
    {
        return response()->json([

            "data" => $strategicAllie,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function edit(StrategicAllie $strategicAllie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function update(SaveStrategicAllieRequest $request, StrategicAllie $strategicAllie)
    {
        $strategicAllie->update($request->all());
        
        return response()->json([

            "message" => "El registro ha sido modificado con ¡Exito!",
            "data" => $strategicAllie,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function destroy(StrategicAllie $strategicAllie)
    {
        $strategicAllie->delete();
        
        return response()->json([

            "message" => "El registro se ha eliminado con ¡Exito!",
            "data" => $strategicAllie,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }
}
