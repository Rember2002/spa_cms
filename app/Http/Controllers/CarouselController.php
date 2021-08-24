<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCarouselRequest;
use App\Http\Resources\CarouselResource;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $carousel = CarouselResource::collection(Carousel::all());

        // return response()->json([

        //     "data" => $carousel,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return CarouselResource::collection(Carousel::all());
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
    public function store(SaveCarouselRequest $request)
    {
        // $carousel = Carousel::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $carousel,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        return (new CarouselResource(Carousel::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function show(Carousel $carousel)
    {
        // return response()->json([

        //     "data" => $carousel,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return new CarouselResource($carousel);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCarouselRequest $request, Carousel $carousel)
    {
        // $carousel->update($request->all());
        
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $carousel,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $carousel->update($request->all());

        return (new CarouselResource($carousel))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carousel $carousel)
    {
        // $carousel->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $carousel,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $carousel->delete();

        return (new CarouselResource($carousel))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
