<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;

use App\Option;

class questionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = Question::where('status' , 1)->get();
        return view('admin.questions.index' , compact('q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required', 
            'position'  => 'required', 
            'options'   => 'required',
            'points'    => 'required',
        ] , [
            'title.required'     => 'Ingresa el título de la pregunta', 
            'position.required'  => 'Selecciona la pocición de la pregunta', 
            'options.required'   => 'Ingresa al menos una opción para la pregunta',
            'points.required'    => 'Ingresa la puntuación de la pregunta',
        ]);

        $v_old = Question::where('position' , $request->position)->first();
        if ($v_old) {
            $v_old->position = Question::conut() + 1;
            $v_old->save();
        }

        $q = new Question;
        $q->title    = $request->title;
        $q->position = $request->position;
        $q->points   = $request->points;
        $q->status   = 1;
        $q->save();

        foreach ($request->options as $key => $value) {
            $o = new Option;
            $o->question_id = $q->id;
            $o->title       = $value;
            $o->position    = $key;
            if ($key == $request->correct) {
                $o->correct = 1;
            }
            $o->save();
        }

        return redirect('/admin/questions')->with('msj' , 'Pregunta agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $q = Question::find($id);
        return view('admin.questions.edit' , compact('q'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'title'     => 'required', 
            'position'  => 'required', 
            'options'   => 'required', 
            'points'    => 'required', 
        ] , [
            'title.required'     => 'Ingresa el título de la pregunta', 
            'position.required'  => 'Selecciona la pocición de la pregunta', 
            'options.required'   => 'Ingresa al menos una opción para la pregunta',
            'points.required'    => 'Ingresa la puntuación de la pregunta',
        ]);

        $q = Question::find($id);
        $v_old = Question::where('position' , $request->position)->first();
        if ($v_old && $v_old->id != $q->id) {
            $v_old->position = $q->position;
            $v_old->save();
        }
        $q->title    = $request->title;
        $q->position = $request->position;
        $q->points   = $request->points;
        $q->save();

        foreach ($q->getOpt as $oo) {
            $oo->delete();
        }

        foreach ($request->options as $key => $value) {
            $o = new Option;
            $o->question_id = $q->id;
            $o->title       = $value;
            $o->position    = $key;
            if ($key == $request->correct) {
                $o->correct = 1;
            }
            $o->save();
        }

        return back()->with('msj' , 'Pregunta editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $q = Question::find($id);
        $q->status = 0;
        $q->save();

        return back()->with('msj' , 'Pregunta eliminada exitosamente');
    }
}
