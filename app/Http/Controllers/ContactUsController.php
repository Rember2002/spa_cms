<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveContactUsRequest;
use App\Http\Requests\UpdateContactUsRequest;
use App\Http\Resources\ContactUsResource;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactUsResource::collection(ContactUs::all());
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
    public function store(SaveContactUsRequest $request)
    {

        return (new ContactUsResource(ContactUs::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        return new ContactUsResource($contactUs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactUsRequest $request, ContactUs $contactU)
    {
        $contactU->update($request->all());

        return (new ContactUsResource($contactU))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactU)
    {

        $contactU->delete();

        return (new ContactUsResource($contactU))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
