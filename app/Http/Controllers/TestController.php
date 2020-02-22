<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Test;

use App\UserTest;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $t = Test::all();
        return view('admin.test.index' , compact('t'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test.create');
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
            'cover'       => 'required'
        ] , [
            'title.required'       => 'Ingresa el título del producto',
            'description.required' => 'Ingresa la descripción del producto',
            'cover.required'       => 'Ingresa la foto del producto',
        ]);

        $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();

        $t = new Test;
        $t->title = $request->title;
        $t->description = $request->description;
        $t->cover       = $name_cover;
        $t->save();

        $request->cover->move(public_path().'/files/test/' , $name_cover);

        return redirect('/admin/test/')->with('msj' , 'Producto agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $t = Test::find($id);
        return view('admin.test.show' , compact('t'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $t = Test::find($id);
        return view('admin.test.edit' , compact('t'));
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
            // 'cover'       => 'required'
        ] , [
            'title.required'       => 'Ingresa el título del producto',
            'description.required' => 'Ingresa la descripción del producto',
            'cover.required'       => 'Ingresa la foto del producto',
        ]);


        $t = Test::find($id);
        $t->title       = $request->title;
        $t->description = $request->description;

        if ($request->cover) {
            @unlink(public_path().'/files/test/'.$t->cover);
            $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();
            $t->cover = $name_cover;
            $request->cover->move(public_path().'/files/test/' , $name_cover);
        }
        $t->save();

        return back()->with('msj' , 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r  = Test::find($id);
        $ut = UserTest::where('test_id' , $id)->get();

        if (count($ut) > 0) {
            foreach ($ut as $u) {
                $u->delete();
            }
        }

        $r->delete(); 
        return back()->with('msj' , 'Producto eliminado exitosamente');
    }
}
