<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAcademicOfferRequest;
use App\Http\Requests\UpdateAcademicOfferRequest;
use App\Http\Resources\AcademicOfferResource;
use App\Models\AcademicOffer;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AcademicOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AcademicOfferResource::collection(AcademicOffer::all());
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
    public function store(SaveAcademicOfferRequest $request, AcademicOffer $academicOffer)
    {
        $academicOffer->name_offer = $request->name_offer;
        $academicOffer->description = $request->description;
        $academicOffer->state = $request->state;
        $path = $request->file('image')->store('images_aboutus');
        $academicOffer->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $academicOffer->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicOffer  $academicOffer
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicOffer $academicOffer)
    {
        return new AcademicOfferResource($academicOffer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicOffer  $academicOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicOffer $academicOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicOffer  $academicOffer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcademicOfferRequest $request, AcademicOffer $academicOffer)
    {
        $academicOffer->name = $request->name;
        $academicOffer->description = $request->description;
        $academicOffer->state = $request->state;
        $oldPath = $academicOffer->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_aboutus');
            $academicOffer->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $academicOffer->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicOffer  $academicOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicOffer $academicOffer)
    {
        if ($academicOffer->delete()){
            Storage::delete($academicOffer->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $academicOffer,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $academicOffer,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
