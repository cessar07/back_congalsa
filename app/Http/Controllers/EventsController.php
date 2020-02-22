<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

use DateTime;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $e = Event::all();
        return view('admin.events.index' , compact('e'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
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
            'title'       => 'required',
            'description' => 'required',
            'date_from'   => 'required',
            'time'        => 'required',
            'address'     => 'required',
            'difficulty'  => 'required',
            'time_total'  => 'required',
            'cover'       => 'required',
        ] , [
            'title.required'       => 'Ingresa el título del evento',
            'description.required' => 'Ingresa la descripción del evento',
            'date_from.required'   => 'Ingresa la fecha del evento',
            'time.required'        => 'Ingresa la hora del evento',
            'address.required'     => 'Ingresa la dirección del evento',
            'difficulty.required'  => 'Selecciona la dificultad del evento',
            'time_total.required'  => 'Ingresa el tiempo de duración del evento',
            'cover.required'       => 'Ingresa la foto de portada del evento',
        ]);

        $name_cover = md5($request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();

        $date_from = DateTime::createFromFormat('d/m/Y', $request->date_from);

        $e = new Event;
        $e->title         = $request->title;
        $e->description   = $request->description;
        $e->address       = $request->address;
        $e->date_from     = $date_from->format('Y-m-d');
        $e->time          = $request->time;
        $e->cover         = $name_cover;
        $e->status        = 1;
        $e->limit_users   = 0;
        $e->confirm_users = 0;
        $e->difficulty    = $request->difficulty;
        $e->time_total    = $request->time_total;
        // $e->str_date    = strtotime($date_from->format('Y-m-d'));
        $e->save();

        $request->cover->move(public_path().'/files/events' , $name_cover);

        return redirect('/admin/events')->with('msj' , 'Evento agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e = Event::find($id);
        return view('admin.events.show' , compact('e'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $e = Event::find($id);
        return view('admin.events.edit' , compact('e'));
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
            'title'       => 'required',
            'description' => 'required',
            'date_from'   => 'required',
            'time'        => 'required',
            'address'     => 'required',
            'difficulty'  => 'required',
            'time_total'  => 'required',
            // 'cover'       => 'required',
        ] , [
            'title.required'       => 'Ingresa el título del evento',
            'description.required' => 'Ingresa la descripción del evento',
            'date_from.required'   => 'Ingresa la fecha del evento',
            'time.required'        => 'Ingresa la hora del evento',
            'address.required'     => 'Ingresa la dirección del evento',
            'difficulty.required'  => 'Selecciona la dificultad del evento',
            'time_total.required'  => 'Ingresa el tiempo de duración del evento',
            'cover.required'       => 'Ingresa la foto de portada del evento',
        ]);

        $date_from = DateTime::createFromFormat('d/m/Y', $request->date_from);

        $e = Event::find($id);
        $e->title         = $request->title;
        $e->description   = $request->description;
        $e->address       = $request->address;
        $e->date_from     = $date_from->format('Y-m-d');
        $e->time          = $request->time;
        $e->difficulty    = $request->difficulty;
        $e->time_total    = $request->time_total;
        // $e->str_date    = strtotime($date_from->format('Y-m-d'));

        if ($request->cover) {
            @unlink(public_path().'/files/events/'.$e->cover);
            $name_cover = md5($request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();
            $request->cover->move(public_path().'/files/events' , $name_cover);
            $e->cover = $name_cover;
        }
        $e->save();
        return back()->with('msj' , 'Evento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
