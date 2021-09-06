<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveServiceHomeRequest;
use App\Http\Requests\UpdateServiceHomeRequest;
use App\Http\Resources\ServiceHomeResource;
use App\Models\ServiceHome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ServiceHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(SaveServiceHomeRequest $request, ServiceHome $serviceHome)
    {
        $serviceHome->state = $request->state;
        $serviceHome->link = $request->link;
        $path = $request->file('image')->store('images_servicehome');
        $serviceHome->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $serviceHome->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceHome  $serviceHome
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceHome $serviceHome)
    {

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
    public function update(UpdateServiceHomeRequest $request, ServiceHome $servicesHome)
    {
        $servicesHome->state = $request->state;
        $servicesHome->link = $request->link;
        $oldPath = $servicesHome->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_servicehome');
            $servicesHome->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $servicesHome->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceHome  $serviceHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceHome $servicesHome)
    {
        if ($servicesHome->delete()){
            Storage::delete($servicesHome->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $servicesHome,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $servicesHome,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
