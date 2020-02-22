<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VideoQuestion;

class videoQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $v = VideoQuestion::where('status' , 1)->get();
        return view('admin.questions.videos' , compact('v'));
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
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'required',
            'video' => 'required'
        ] , [
            'title.required' => 'Ingresa el título del video',
            'video.required' => 'Ingresa el archivo del video'
        ]);

        $name_file = md5(uniqid().$request->video->getClientOriginalName()).'.'.$request->video->getClientOriginalExtension();

        return $name_file;

        return $request->video->move(public_path().'/files/videos' , $name_file);
        return $dd;
        $v = new VideoQuestion;
        $v->title  = $request->title;
        $v->status = 1;
        $v->file   = $name_file;
        $v->save();


        return redirect('/admin/videos-question')->with('msj' , 'Video agregado exitosamente');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $v = VideoQuestion::find($id);
        @unlink(public_path().'/files/videos/'.$v->file);
        $v->delete();
        
        return back()->with('msj' , 'Video eliminado exitosamente');
    }

    public function uploadGallery(Request $r){
        $name_video = md5($r->file->getClientOriginalName()).'.'.$r->file->getClientOriginalExtension();
        $c = VideoQuestion::count()+1;

        $v = new VideoQuestion;
        $v->title  = 'video_'.$c;
        $v->status = 1;
        $v->file   = $name_video;
        $v->save();

        $r->file->move(public_path().'/files/videos' , $name_video);
        return 1;
    }
}
