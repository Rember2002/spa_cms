<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAboutUsRequest;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $aboutUs = AboutUsResource::collection(AboutUs::all());

        // return response()->json([

        //     "data" => $aboutUs,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return AboutUsResource::collection(AboutUs::all());
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
    public function store(SaveAboutUsRequest $request)
    {
        // $aboutUs = AboutUs::create($request->all());

        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $aboutUs,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        $path = $request->file('image')->store('image');

        $this->image = $path;

        return (new AboutUsResource(AboutUs::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        // return response()->json([

        //     "data" => $aboutUs,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return new AboutUsResource($aboutUs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(SaveAboutUsRequest $request, AboutUs $aboutUs)
    {
        // $aboutUs->update($request->all());

        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $aboutUs,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $aboutUs->update($request->all());

        return (new AboutUsResource($aboutUs))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUs $aboutUs)
    {
        // $aboutUs->delete();

        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $aboutUs,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $aboutUs->delete();

        return (new AboutUsResource($aboutUs))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
