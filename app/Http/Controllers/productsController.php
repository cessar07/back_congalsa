<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Product::where('status' , 1)->get();
        return view('admin.products.index' , compact('p'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
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
            'points'      => 'required',
            'description' => 'required',
            'cover'       => 'required',
        ] , [
            'title.required'       => 'Ingresa el título del producto',
            'points.required'      => 'Ingresa la cantidad de puntos requeridos',
            'description.required' => 'Ingresa la descripción del producto',
            'cover.required'       => 'Ingresa la foto del producto',
        ]);

        $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();

        $p = new Product;
        $p->title       = $request->title;
        $p->points      = $request->points;
        $p->description = $request->description;
        $p->cover       = url('/files/products/'.$name_cover);
        $p->status      = 1;
        $p->save();

        $request->cover->move(public_path().'/files/products/' , $name_cover);

        return redirect('/admin/products')->with('msj' , 'Producto agregado exitosamente');
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
        $p = Product::find($id);
        return view('admin.products.edit' , compact('p'));
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
            'points'      => 'required',
            'description' => 'required',
            // 'cover'       => 'required',
        ] , [
            'title.required'       => 'Ingresa el título del producto',
            'points.required'      => 'Ingresa la cantidad de puntos requeridos',
            'description.required' => 'Ingresa la descripción del producto',
            'cover.required'       => 'Ingresa la foto del producto',
        ]);


        $p = Product::find($id);
        $p->title       = $request->title;
        $p->points      = $request->points;
        $p->description = $request->description;
        if ($request->cover) {
            @unlink(public_path().'/files/products/'.$p->cover);
            $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();
            $p->cover   = url('/files/products/'.$name_cover);
            $request->cover->move(public_path().'/files/products/' , $name_cover);
        }
        $p->save();


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
        $p = Product::find($id);
        $p->status = 0;
        $p->save();

        return back()->with('msj' , 'Producto eliminado exitosamente');
    }
}
