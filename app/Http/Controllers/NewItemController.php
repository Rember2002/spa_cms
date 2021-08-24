<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewItemRequest;
use App\Http\Resources\NewHomeResource;
use App\Http\Resources\NewItemResource;
use App\Models\NewHome;
use App\Models\NewItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $newItem = NewItemResource::collection(NewItem::all());

        // return response()->json([

        //     "data" => $newItem,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return NewItemResource::collection(NewItem::all());
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
    public function store(SaveNewItemRequest $request)
    {
        // $newItem = NewItem::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $newItem,
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
     * @param  \App\Models\NewItem  $newItem
     * @return \Illuminate\Http\Response
     */
    public function show(NewItem $newItem)
    {
        // return response()->json([

        //     "data" => $newItem,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return new NewItemResource($newItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewItem  $newItem
     * @return \Illuminate\Http\Response
     */
    public function edit(NewItem $newItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewItem  $newItem
     * @return \Illuminate\Http\Response
     */
    public function update(SaveNewItemRequest $request, NewItem $newItem)
    {
        // $newItem->update($request->all());
        
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $newItem,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $newItem->update($request->all());

        return (new NewItemResource($newItem))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewItem  $newItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewItem $newItem)
    {
        // $newItem->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $newItem,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $newItem->delete();

        return (new NewItemResource($newItem))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
