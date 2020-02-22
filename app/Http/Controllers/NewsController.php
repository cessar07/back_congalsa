<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BlogCategory;

use App\Entry; 

use Illuminate\Support\Str;

use DateTime;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $e = Entry::all();
        return view('admin.blog.index' , compact('e'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = BlogCategory::where('status' , 1)->get();
        return view('admin.blog.create' , compact('cat'));
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
            'content'     => 'required',
            'category'    => 'required',
            'status'      => 'required',
            'cover'       => 'required',
        ] , [
            'title.required'       => 'Ingresa el título de la noticia',
            'content.required'     => 'Ingresa el contenido de la noticia',
            'category.required'    => 'Selecciona la categoría de la noticia',
            'status.required'      => 'Selecciona el estatus de la noticia',
            'cover.required'       => 'Ingresa la foto de portada de la noticia',
        ]);

        $name_cover = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();

        $e = new Entry;
        $e->title       = $request->title;
        $e->description = $request->content;
        $e->category_id = $request->category;
        $e->status      = $request->status;
        $e->slug        = Str::slug($request->title , '-');
        if ($request->date_publish) {
            $date = DateTime::createFromFormat('d/m/Y', $request->date_publish);
            $e->publish_at = $date;
        }
        $e->cover = $name_cover;
        $e->save();

        $request->cover->move(public_path().'/files/entries/' , $name_cover);

        return redirect('/admin/news')->with('msj' , 'Noticia agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e = Entry::find($id);
        return view('admin.blog.show' , compact('e'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $e   = Entry::find($id);
        $cat = BlogCategory::where('status' , 1)->get();
        return view('admin.blog.edit' , compact('e' , 'cat')); 
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
            'content' => 'required',
            'category'    => 'required',
            'status'      => 'required',
            // 'cover'       => 'required',
        ] , [
            'title.required'       => 'Ingresa el título de la noticia',
            'content.required' => 'Ingresa el contenido de la noticia',
            'category.required'    => 'Selecciona la categoría de la noticia',
            'status.required'      => 'Selecciona el estatus de la noticia',
            'cover.required'       => 'Ingresa la foto de portada de la noticia',
        ]);

        $e = Entry::find($id);
        $e->title       = $request->title;
        $e->description = $request->content;
        $e->category_id = $request->category;
        $e->status      = $request->status;
        $e->slug        = Str::slug($request->title , '-');
        if ($request->date_publish) {
            $date = DateTime::createFromFormat('d/m/Y', $request->date_publish);
            $e->publish_at = $date;
        }
        if ($request->status != 2) {
            $e->publish_at = null;
        }
        if ($request->cover) {
            @unlink(public_path().'/files/entries/'.$e->cover);
            $name_cover    = md5($request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();
            $e->cover = $name_cover;
            $request->cover->move(public_path().'/files/entries/' , $name_cover);
        }
        $e->save();

        return back()->with('msj' , 'Noticia editada exitosamente');
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

    public function updateStatus($id){
        $b = Entry::find($id);
        if ($b->status == 1) {
            $b->status = 0;
        }else{
            $b->status = 1;
        }
        $b->save();
        return back()->with('msj' , 'Noticia actualizada exitosamente');
    }

    public function categories(){
        $cat = BlogCategory::all();
        return view('admin.blog.categories' , compact('cat'));
    }

    public function storeCategories(Request $r){
        $r->validate([
            'title'       => 'required',
            'description' => 'required'
        ] , [
            'title.required'       => 'Ingresa el nombre de la categoría',
            'description.required' => 'Ingresa la descripción de la categoría'
        ]);

        $c              = new BlogCategory;
        $c->title       = $r->title;
        $c->description = $r->description;
        $c->status      = 1;
        $c->save();

        return back()->with('msj' , 'Categoría agregada exitosamente');
    }

    public function editCategories($id){
        $cat = BlogCategory::all();
        $ca  = BlogCategory::find($id);
        return view('admin.blog.categories' , compact('cat' , 'ca'));
    }

    public function updateCategories(Request $r , $id){
        $r->validate([
            'title'       => 'required',
            'description' => 'required'
        ] , [
            'title.required'       => 'Ingresa el nombre de la categoría',
            'description.required' => 'Ingresa la descripción de la categoría'
        ]);

        $c              = BlogCategory::find($id);
        $c->title       = $r->title;
        $c->description = $r->description;
        $c->save();

        return back()->with('msj' , 'Categoría actualizada exitosamente');
    }

    public function updateStatusCategories($id){
        $b = BlogCategory::find($id);
        if ($b->status == 1) {
            $b->status = 0;
        }else{
            $b->status = 1;
        }
        $b->save();
        return back()->with('msj' , 'Categoría actualizada exitosamente');
    }

    public function uploadFileMedia(Request $request){
        $name_file = md5(uniqid().$request->file->getClientOriginalName()).'.'.$request->file->getClientOriginalExtension();

        $request->file->move(public_path().'/files/media' , $name_file);

        return response()->json([
            'location' => $name_file
        ]);
    }
}
