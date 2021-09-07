<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCommissionRequest;
use App\Http\Requests\UpdateCommissionRequest;
use App\Http\Resources\CommissionResource;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommissionResource::collection(DB::select('SELECT C.id, C.name_commission, C.image, S.year, C.id_student_council FROM commissions C INNER JOIN student_councils S ON C.id_student_council = S.id'));
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
    public function store(SaveCommissionRequest $request, Commission $commission)
    {
        $commission->name_commission = $request->name_commission;
        $commission->id_student_council = $request->id_student_council;
        $path = $request->file('image')->store('images_commission');
        $commission->image = $path;

            return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $commission->save(),
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission)
    {

        return new CommissionResource($commission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommissionRequest $request, Commission $commision)
    {
        $commision->name_commission = $request->name_commission;
        $commision->id_student_council = $request->id_student_council;
        $oldPath = $commision->image;

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images_commission');
            $commision->image = $path;

            Storage::delete($oldPath);
        }

            return response()->json([
           
            "message" => "El registro se ha modificado ¡Exito!",
            "data" => $commision->save(),
            "status" => Response::HTTP_OK,

        ],  Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commision)
    {
        if ($commision->delete()){
            Storage::delete($commision->image);

            return response()->json([

                "message" => "El registro se ha eliminado con ¡Exito!",
                "data" => $commision,
                "status" => Response::HTTP_OK,
    
            ], Response::HTTP_OK);
        } else {
            return response()->json([

                "message" => "No es posible eliminar el registrlo en estos momentos ¡Error!",
                "data" => $commision,
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
    
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
