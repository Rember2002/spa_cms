<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSalesianExperienceHomeRequest;
use App\Http\Requests\UpdateSalesianExperienceHomeRequest;
use App\Http\Resources\SalesianExperienceHomeResource;
use App\Http\Resources\SalesianExperienceResource;
use App\Models\SalesianExperienceHome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SalesianExperienceHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return SalesianExperienceHomeResource::collection(SalesianExperienceHome::all());
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
    public function store(SaveSalesianExperienceHomeRequest $request, SalesianExperienceHome $salesianExperienceHome)
    {
        $salesianExperienceHome->description = $request->description;
        $salesianExperienceHome->year = $request->year;
        $path = $request->file('image')->store('images_salesianexperiencehome');
        $salesianExperienceHome->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $salesianExperienceHome->save(),
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
        
        return new SalesianExperienceHomeResource($salesianExperienceHome);

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
    public function update(UpdateSalesianExperienceHomeRequest $request, SalesianExperienceHome $salesianExperienceHome)
    {
        $salesianExperienceHome->description = $request->description;
        $salesianExperienceHome->year = $request->year;
        $oldPath = $salesianExperienceHome->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_salesianexperiencehome');
            $salesianExperienceHome->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $salesianExperienceHome->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesianExperienceHome  $salesianExperienceHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesianExperienceHome $salesianExperienceHome)
    {
        if ($salesianExperienceHome->delete()){
            Storage::delete($salesianExperienceHome->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $salesianExperienceHome,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $salesianExperienceHome,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
