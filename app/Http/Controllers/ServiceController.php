<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::all();

        return response()->json([

            "data" => $service,
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
    public function store(SaveServiceRequest $request)
    {
        $service = Service::create($request->all());
        
        return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $service,
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return response()->json([

            "data" => $service,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(SaveServiceRequest $request, Service $service)
    {
        $service->update($request->all());
       
        return response()->json([

            "message" => "El registro ha sido modificado con ¡Exito!",
            "data" => $service,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        
        return response()->json([

            "message" => "El registro se ha eliminado con ¡Exito!",
            "data" => $service,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }
}
