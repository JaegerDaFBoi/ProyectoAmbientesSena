<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\LearningOutcome;
use App\Models\Program;
use Illuminate\Http\Request;

class LearningOutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idcompetencia)
    {
        $competencia = Competence::where('isEliminated', false)->where('id', $idcompetencia)->first();
        $programa = Program::where('isEliminated', false)->where('id', $competencia->fk_programa)->first();
        return view('resultados.create', compact('competencia', 'programa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function show(LearningOutcome $learningOutcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function edit(LearningOutcome $learningOutcome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LearningOutcome $learningOutcome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LearningOutcome  $learningOutcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(LearningOutcome $learningOutcome)
    {
        //
    }
}
