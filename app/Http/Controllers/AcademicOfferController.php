<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAcademicOfferRequest;
use App\Http\Resources\AcademicOfferResource;
use App\Models\AcademicOffer;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AcademicOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Grade $grade)
    {
        // $academicOffer = AcademicOfferResource::collection(AcademicOffer::findOutFill($grade->id));

        // return response()->json([

        //     "data" => $academicOffer,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return AcademicOfferResource::collection(AcademicOffer::findOutFill($grade->id));
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
    public function store(SaveAcademicOfferRequest $request)
    {
        // $academicOffer = AcademicOffer::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $academicOffer,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        return (new AcademicOfferResource(AcademicOffer::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicOffer  $academicOffer
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicOffer $academicOffer)
    {
        // return response()->json([

        //     "data" => $academicOffer,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

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
    public function update(SaveAcademicOfferRequest $request, AcademicOffer $academicOffer)
    {
        // $academicOffer->update($request->all());
        
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $academicOffer,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $academicOffer->update($request->all());

        return (new AcademicOfferResource($academicOffer))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicOffer  $academicOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicOffer $academicOffer)
    {
        // $academicOffer->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $academicOffer,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $academicOffer->delete();

        return (new AcademicOfferResource($academicOffer))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
