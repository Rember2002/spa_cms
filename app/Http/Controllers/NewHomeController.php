<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewHomeRequest;
use App\Http\Requests\UpdateNewHomeRequest;
use App\Http\Resources\NewHomeResource;
use App\Models\NewHome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class NewHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(SaveNewHomeRequest $request, NewHome $newHome)
    {
        $newHome->status = $request->status;
        $path = $request->file('image')->store('images_newhome');
        $newHome->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $newHome->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewHome  $newHome
     * @return \Illuminate\Http\Response
     */
    public function show(NewHome $newHome)
    {

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
    public function update(UpdateNewHomeRequest $request, NewHome $newHome)
    {
        $newHome->status = $request->status;
        $oldPath = $newHome->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_newhome');
            $newHome->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $newHome->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewHome  $newHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewHome $newHome)
    {
        if ($newHome->delete()){
            Storage::delete($newHome->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $newHome,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $newHome,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
