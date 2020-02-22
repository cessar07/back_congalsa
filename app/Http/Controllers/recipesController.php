<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RecipeCategory;

use App\Recipe;

use App\RecipeIngredient;

class recipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $r = Recipe::all();
        return view('admin.recipes.index' , compact('r'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = RecipeCategory::where('status' , 1)->get();
        return view('admin.recipes.create' , compact('cat'));
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
            'category'    => 'required',
            'time'        => 'required',
            'difficulty'  => 'required',
            'preparation' => 'required',
            'cover'       => 'required',
            'ingrdient'   => 'required',
            'persons'   => 'required',
        ] , [
            'title.required'       => 'Ingresa el título de la receta',
            'category.required'    => 'Selecciona la categoría de la receta',
            'time.required'        => 'Ingresa el tiempo de preparación de la receta',
            'difficulty.required'  => 'Selecciona la dificultad de la receta',
            'preparation.required' => 'Ingresa el método de preparación de la receta',
            'cover.required'       => 'Ingresa la imagen de la receta',
            'ingrdient.required'   => 'Ingresa los ingredientes de la receta',
            'persons.required'     => 'Ingresa el número de personas de la receta',
        ]);

        $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();

        $r = new Recipe;
        $r->title = $request->title;
        $r->category_id = $request->category;
        $r->time        = $request->time;
        $r->difficulty  = $request->difficulty;
        $r->preparation = $request->preparation;
        $r->persons     = $request->persons;
        $r->cover       = $name_cover;
        $r->save();

        foreach ($request->ingrdient as $i) {
            $ri = new RecipeIngredient;
            $ri->recipe_id = $r->id;
            $ri->item      = $i;
            $ri->save();
        }
        $request->cover->move(public_path().'/files/recipes/' , $name_cover);

        return redirect('/admin/recipes')->with('msj' , 'Receta agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $r = Recipe::find($id);
        return view('admin.recipes.show' , compact('r'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $r   = Recipe::find($id);
        $cat = RecipeCategory::where('status' , 1)->get();
        return view('admin.recipes.edit' , compact('r' , 'cat'));
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
            'category'    => 'required',
            'time'        => 'required',
            'difficulty'  => 'required',
            'preparation' => 'required',
            // 'cover'       => 'required',
            'ingrdient'   => 'required',
            'persons'     => 'required',
        ] , [
            'title.required'       => 'Ingresa el título de la receta',
            'category.required'    => 'Selecciona la categoría de la receta',
            'time.required'        => 'Ingresa el tiempo de preparación de la receta',
            'difficulty.required'  => 'Selecciona la dificultad de la receta',
            'preparation.required' => 'Ingresa el método de preparación de la receta',
            'cover.required'       => 'Ingresa la imagen de la receta',
            'ingrdient.required'   => 'Ingresa los ingredientes de la receta',
            'persons.required'     => 'Ingresa el número de personas de la receta',
        ]);


        $r = Recipe::find($id);
        $r->title       = $request->title;
        $r->category_id = $request->category;
        $r->time        = $request->time;
        $r->difficulty  = $request->difficulty;
        $r->preparation = $request->preparation;
        $r->persons     = $request->persons;

        $old_i = RecipeIngredient::where('recipe_id' , $r->id)->get();

        if (count($old_i) > 0) {
            foreach ($old_i as $o_i) {
                $o_i->delete();
            }
        }

        foreach ($request->ingrdient as $i) {
            $ri = new RecipeIngredient;
            $ri->recipe_id = $r->id;
            $ri->item      = $i;
            $ri->save();
        }

        if ($request->cover) {
            @unlink(public_path().'/files/recipes/'.$r->cover);
            $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();
            $r->cover = $name_cover;
            $request->cover->move(public_path().'/files/recipes/' , $name_cover);
        }
        
        $r->save();

        return back()->with('msj' , 'Receta actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r = Recipe::find($id);
        $i = RecipeIngredient::where('recipe_id' , $r->id)->get();

        if (count($i) > 0) {
            foreach ($i as $in) {
                $in->delete();
            }
        }

        $r->delete();
        return back()->with('msj' , 'Receta eliminada exitosamente');
    }

    public function categories(){
        $cat = RecipeCategory::all();
        return view('admin.recipes.categories' , compact('cat'));
    }

    public function storeCategories(Request $r){
        $r->validate([
            'title'       => 'required',
            'description' => 'required'
        ] , [
            'title.required'       => 'Ingresa el nombre de la categoría',
            'description.required' => 'Ingresa la descripción de la categoría'
        ]);

        $c              = new RecipeCategory;
        $c->title       = $r->title;
        $c->description = $r->description;
        $c->status      = 1;
        $c->save();

        return back()->with('msj' , 'Categoría agregada exitosamente');
    }

    public function editCategories($id){
        $cat = RecipeCategory::all();
        $ca  = RecipeCategory::find($id);
        return view('admin.recipes.categories' , compact('cat' , 'ca'));
    }

    public function updateCategories(Request $r , $id){
        $r->validate([
            'title'       => 'required',
            'description' => 'required'
        ] , [
            'title.required'       => 'Ingresa el nombre de la categoría',
            'description.required' => 'Ingresa la descripción de la categoría'
        ]);

        $c              = RecipeCategory::find($id);
        $c->title       = $r->title;
        $c->description = $r->description;
        $c->save();

        return back()->with('msj' , 'Categoría actualizada exitosamente');
    }

    public function updateStatusCategories($id){
        $b = RecipeCategory::find($id);
        if ($b->status == 1) {
            $b->status = 0;
        }else{
            $b->status = 1;
        }
        $b->save();
        return back()->with('msj' , 'Categoría actualizada exitosamente');
    }
}
