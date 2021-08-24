<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewHomeRequest;
use App\Http\Resources\NewHomeResource;
use App\Models\NewHome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $newHome = NewHomeResource::collection(NewHome::all());

        // return response()->json([

        //     "data" => $newHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return NewHomeResource::collection(NewHome::all());
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
    public function store(SaveNewHomeRequest $request)
    {
        // $newHome = NewHome::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $newHome,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        return (new NewHomeResource(NewHome::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewHome  $newHome
     * @return \Illuminate\Http\Response
     */
    public function show(NewHome $newHome)
    {
        // return response()->json([

        //     "data" => $newHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return new NewHomeResource($newHome);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewHome  $newHome
     * @return \Illuminate\Http\Response
     */
    public function edit(NewHome $newHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewHome  $newHome
     * @return \Illuminate\Http\Response
     */
    public function update(SaveNewHomeRequest $request, NewHome $newHome)
    {
        // $newHome->update($request->all());
        
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $newHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $newHome->update($request->all());

        return (new NewHomeResource($newHome))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewHome  $newHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewHome $newHome)
    {
        // $newHome->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $newHome,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $newHome->delete();

        return (new NewHomeResource($newHome))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
