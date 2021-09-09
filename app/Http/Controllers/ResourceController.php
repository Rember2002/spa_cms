<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourceResource::collection(Resource::all());
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
    public function store(SaveResourceRequest $request, Resource $resource)
    {
        $resource->name_resource = $request->name_resource;
        $resource->description = $request->description;
        $pathImage = $request->file('image')->store('images_resource');
        $resource->image = $pathImage;
        $pathDocument = $request->file('document')->store('document_resource');
        $resource->document = $pathDocument;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $resource->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {

        return new ResourceResource($resource);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        
        $resource->name_resource = $request->name_resource;
        $resource->description = $request->description;
        $oldPathImage = $resource->image;
        $oldPathDocument = $resource->document;

        if($request->hasFile('image')) {

            $pathImage = $request->file('image')->store('images_resource');
            $resource->image = $pathImage;

            Storage::delete($oldPathImage);

            if($request->hasFile('document')){
                
                $pathDocument = $request->file('document')->store('document_resource');
                $resource->document = $pathDocument;

                Storage::delete($oldPathDocument);

                
            }   return response()->json([
           
                "message" => "El registro se ha modificado ¡Exito!",
                "data" => $resource->save(),
                "status" => Response::HTTP_OK,
    
            ],  Response::HTTP_OK);
            
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $resource->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        if ($resource->delete()){
            
            Storage::delete($resource->document);

            Storage::delete($resource->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $resource,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $resource,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
