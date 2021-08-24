<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveServiceHomeRequest;
use App\Http\Resources\ServiceHomeResource;
use App\Models\ServiceHome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $serviceHome = ServiceHomeResource::collection(ServiceHome::all());

        // return response()->json([

        //     "data" => $serviceHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return ServiceHomeResource::collection(ServiceHome::all());

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
    public function store(SaveServiceHomeRequest $request)
    {
        // $serviceHome = ServiceHome::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $serviceHome,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        return (new ServiceHomeResource(ServiceHome::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceHome  $serviceHome
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceHome $serviceHome)
    {
        // return response()->json([

        //     "data" => $serviceHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return new ServiceHomeResource($serviceHome);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceHome  $serviceHome
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceHome $serviceHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceHome  $serviceHome
     * @return \Illuminate\Http\Response
     */
    public function update(SaveServiceHomeRequest $request, ServiceHome $serviceHome)
    {
        // $serviceHome->update($request->all());
        
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $serviceHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $serviceHome->update($request->all());

        return (new ServiceHomeResource($serviceHome))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceHome  $serviceHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceHome $serviceHome)
    {
        // $serviceHome->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $serviceHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return (new ServiceHomeResource($serviceHome))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
