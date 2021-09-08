<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveIntegrantRequest;
use App\Http\Resources\IntegrantResource;
use App\Models\Integrant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IntegrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IntegrantResource::collection(DB::select('SELECT i.id, i.name_integrant, i.image, i.id_commission, c.name_commission, s.year FROM integrants i INNER JOIN commissions c ON i.id_commission=c.id INNER JOIN student_councils s ON c.id_student_council = s.id'));
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
    public function store(SaveIntegrantRequest $request, Integrant $integrant)
    {
        $integrant->name_integrant = $request->name_integrant;
        $integrant->id_commission = $request->id_commission;
        $path = $request->file('image')->store('images_integrants');
        $integrant->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $integrant->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function show(Integrant $integrant)
    {
        return new IntegrantResource($integrant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function edit(Integrant $integrant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function update(SaveIntegrantRequest $request, Integrant $integrant)
    {
        $integrant->name_integrant = $request->name_integrant;
        $integrant->id_commission = $request->id_commission;
        $oldPath = $integrant->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_commission');
            $integrant->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $integrant->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Integrant  $integrant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Integrant $integrant)
    {
        if ($integrant->delete()){
            Storage::delete($integrant->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $integrant,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $integrant,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
