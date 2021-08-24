<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $question = QuestionResource::collection(Question::all());

        // return response()->json([

        //     "data" => $question,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return QuestionResource::collection(Question::all());
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
    public function store(SaveQuestionRequest $request)
    {
        // $question = Question::create($request->all());
        
        // return response()->json([
           
        //     "message" => "El registro ingresado se ha creado con ¡Exito!",
        //     "data" => $question,
        //     "status" => Response::HTTP_CREATED,

        // ],  Response::HTTP_CREATED);

        return (new QuestionResource(Question::create($request->all())))
            ->additional(["message" => "El registro ingresado se ha creado con ¡Exito!",])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // return response()->json([

        //     "data" => $question,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        return new QuestionResource($question);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(SaveQuestionRequest $request, Question $question)
    {
        // $question->update($request->all());
        
        // return response()->json([

        //     "message" => "El registro ha sido modificado con ¡Exito!",
        //     "data" => $question,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $question->update($request->all());

        return (new QuestionResource($question))
            ->additional(["message" => "El registro ha sido modificado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // $question->delete();
        
        // return response()->json([

        //     "message" => "El registro se ha eliminado con ¡Exito!",
        //     "data" => $question,
        //     "status" => Response::HTTP_OK,

        // ], Response::HTTP_OK);

        $question->delete();

        return (new QuestionResource($question))
            ->additional(["message" => "El registro se ha eliminado con ¡Exito!"])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
