<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Social;

class socialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s = Social::all();
        return view('admin.socials.index' , compact('s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.socials.create');
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
            'service'    => 'required',
            'type'       => 'required',
            'conditions' => 'required',
            'company'    => 'required',
            // 'phone'      => 'required',
            // 'address'    => 'required',
            'vigor'      => 'required',
        ] , [
            'service.required'    => 'Ingresa el servicio de la mejora',
            'type.required'       => 'Ingresa el tipo de servicio de la mejora',
            'conditions.required' => 'Ingresa las condicones de la mejora',
            'company.required'    => 'Ingresa la compañia de la mejora',
            'phone.required'      => 'Ingresa el teléfono de la mejora',
            'address.required'    => 'Ingresa la dirección de la mejora',
            'vigor.required'      => 'Selecciona el vigor de la mejora',
        ]);

        $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();

        $s = new Social;
        $s->service = $request->service;
        $s->type = $request->type;
        $s->conditions = $request->conditions;
        $s->company = $request->company;
        $s->phone = $request->phone;
        $s->address = $request->address;
        $s->vigor = $request->vigor;
        $s->cover = $name_cover;
        $s->save();

        $request->cover->move(public_path().'/files/socials/' , $name_cover);

        return redirect('/admin/socials')->with('msj' , 'Mejora agregada exitosamente');
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
        $s = Social::find($id);
        return view('admin.socials.edit' , compact('s'));
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
            'service'    => 'required',
            'type'       => 'required',
            'conditions' => 'required',
            'company'    => 'required',
            // 'phone'      => 'required',
            // 'address'    => 'required',
            'vigor'      => 'required',
            'cover'      => 'required',
        ] , [
            'service.required'    => 'Ingresa el servicio de la mejora',
            'type.required'       => 'Ingresa el tipo de servicio de la mejora',
            'conditions.required' => 'Ingresa las condicones de la mejora',
            'company.required'    => 'Ingresa la compañia de la mejora',
            'phone.required'      => 'Ingresa el teléfono de la mejora',
            'address.required'    => 'Ingresa la dirección de la mejora',
            'vigor.required'      => 'Selecciona el vigor de la mejora',
            'vigor.required'      => 'ingresa la portada de la mejora',
        ]);

        $s = Social::find($id);
        $s->service = $request->service;
        $s->type = $request->type;
        $s->conditions = $request->conditions;
        $s->company = $request->company;
        $s->phone = $request->phone;
        $s->address = $request->address;
        $s->vigor = $request->vigor;
        if ($request->cover) {
            @unlink(public_path().'/files/socials/'.$s->cover);
            $name_cover = md5($request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();
            $s->cover = $name_cover;
            $request->cover->move(public_path().'/files/socials/' , $name_cover);
        }
        $s->save();

        return back()->with('msj' , 'Mejora actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Social::find($id);
        $s->delete();
        return back()->with('msj' , 'Mejora eliminada exitosamente');
    }
}
