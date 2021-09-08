<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSalesianExperienceRequest;
use App\Http\Requests\UpdateSalesianExperienceRequest;
use App\Http\Resources\SalesianExperienceResource;
use App\Models\SalesianExperience;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SalesianExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(SaveSalesianExperienceRequest $request, SalesianExperience $salesianExperience)
    {
        $salesianExperience->name_event = $request->name_event;
        $salesianExperience->description = $request->description;
        $salesianExperience->date = $request->date;
        $salesianExperience->place = $request->place;
        $salesianExperience->type = $request->type;
        $path = $request->file('image')->store('images_eventexperience');
        $salesianExperience->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $salesianExperience->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
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
    public function update(UpdateSalesianExperienceRequest $request, SalesianExperience $salesianExperience)
    {
        $salesianExperience->name_event = $request->name_event;
        $salesianExperience->description = $request->description;
        $salesianExperience->date = $request->date;
        $salesianExperience->place = $request->place;
        $salesianExperience->type = $request->type;
        $oldPath = $salesianExperience->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_eventexperience');
            $salesianExperience->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $salesianExperience->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesianExperience  $salesianExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesianExperience $salesianExperience)
    {
        if ($salesianExperience->delete()){
            Storage::delete($salesianExperience->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $salesianExperience,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $salesianExperience,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
