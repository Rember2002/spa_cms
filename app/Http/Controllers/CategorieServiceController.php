<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategorieServiceRequest;
use App\Http\Resources\CategorieServiceResource;
use App\Models\CategorieService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use function PHPUnit\Framework\returnSelf;

class CategorieServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  CategorieServiceResource::collection(CategorieService::select('categorie_services.id', 'categorie_services.name_categorie', 'categorie_services.description', 'categorie_services.id_service', 'services.name_service')
            ->join('services', 'categorie_services.id_service', '=', 'services.id')
            ->get());
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
    public function store(SaveCategorieServiceRequest $request)
    {
        return (new CategorieServiceResource(CategorieService::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorieService  $categorieService
     * @return \Illuminate\Http\Response
     */
    public function show($categorieService)
    
    {  
        return  CategorieServiceResource::collection(CategorieService::select('categorie_services.id', 'categorie_services.name_categorie', 'categorie_services.description', 'categorie_services.id_service', 'services.name_service')
            ->join('services', 'categorie_services.id_service', '=', 'services.id')
            ->where('services.id',$categorieService)
            ->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorieService  $categorieService
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorieService $categorieService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorieService  $categorieService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorieService $categorieService)
    {
        $categorieService->update($request->all());

        return (new CategorieServiceResource($categorieService))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieService  $categorieService
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorieService $categorieService)
    {
        $categorieService->delete();

        return (new CategorieServiceResource($categorieService))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
