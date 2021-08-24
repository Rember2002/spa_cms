<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSectionNavBarRequest;
use App\Models\SectionNavBar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SectionNavBarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectionNavBar = SectionNavBar::all();

        return response()->json([

            "data" => $sectionNavBar,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
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
    public function store(SaveSectionNavBarRequest $request)
    {
        $sectionNavBar = SectionNavBar::create($request->all());

        return response()->json([
           
            "message" => "El registro ingresado se ha creado con ¡Exito!",
            "data" => $sectionNavBar,
            "status" => Response::HTTP_CREATED,

        ],  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SectionNavBar  $sectionNavBar
     * @return \Illuminate\Http\Response
     */
    public function show(SectionNavBar $sectionNavBar)
    {
        return response()->json([

            "data" => $sectionNavBar,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SectionNavBar  $sectionNavBar
     * @return \Illuminate\Http\Response
     */
    public function edit(SectionNavBar $sectionNavBar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SectionNavBar  $sectionNavBar
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSectionNavBarRequest $request, SectionNavBar $sectionNavBar)
    {
        $sectionNavBar->update($request->all());

        return response()->json([

            "message" => "El registro ha sido modificado con ¡Exito!",
            "data" => $sectionNavBar,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectionNavBar  $sectionNavBar
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectionNavBar $sectionNavBar)
    {
        $sectionNavBar->delete();

        return response()->json([

            "message" => "El registro se ha eliminado con ¡Exito!",
            "data" => $sectionNavBar,
            "status" => Response::HTTP_OK,

        ], Response::HTTP_OK);
    }
}
