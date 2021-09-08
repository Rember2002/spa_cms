<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStrategicAllieRequest;
use App\Http\Requests\UpdateStrategicAllieRequest;
use App\Http\Resources\StrategicAllieResource;
use App\Models\StrategicAllie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StrategicAllieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return StrategicAllieResource::collection(StrategicAllie::all());
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
    public function store(SaveStrategicAllieRequest $request, StrategicAllie $strategicAlly)
    {
        $strategicAlly->name_ally = $request->name_ally;
        $strategicAlly->description = $request->description;
        $path = $request->file('image')->store('images_strategically');
        $strategicAlly->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $strategicAlly->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function show(StrategicAllie $strategicAlly)
    {
        return new StrategicAllieResource($strategicAlly);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function edit(StrategicAllie $strategicAllie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStrategicAllieRequest $request, StrategicAllie $strategicAlly)
    {
        $strategicAlly->name_ally = $request->name_ally;
        $strategicAlly->description = $request->description;
        $oldPath = $strategicAlly->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_strategically');
            $strategicAlly->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $strategicAlly->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrategicAllie  $strategicAllie
     * @return \Illuminate\Http\Response
     */
    public function destroy(StrategicAllie $strategicAlly)
    {
        if ($strategicAlly->delete()){
            Storage::delete($strategicAlly->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $strategicAlly,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $strategicAlly,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
