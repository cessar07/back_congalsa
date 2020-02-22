<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $u = User::where('role' , 2)->get();
        return view('admin.users.index' , compact('u'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name'  => 'required',
            'email' => 'email|required|unique:users'
        ] , [
            'name.required'  => 'Ingresa el nombre del usuario',
            'email.required' => 'Ingresa el email del usuario',
            'email.email'    => 'Ingresa un email valido para el usuario',
            'email.unique'   => 'Ya existe un usuario creado con este email',
        ]);
        $cc = User::count()+1;

        $u = new User;  
        $u->name     = $request->name;
        $u->email    = $request->email;
        $u->user     = 'congalsaUser_'.$cc;
        $u->status   = 1;
        $u->role     = 2;
        $u->password = bcrypt('1234567');
        if ($request->cover) {
            $name_avatar = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();

            $u->avatar = url('/files/users/'.$name_avatar);
            $request->cover->move(public_path().'/files/users/' , $name_avatar);
        }
        $u->save();


        return redirect('/admin/users')->with('msj' , 'Usuario agregado exitosamente');
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
        $u = User::find($id);
        return view('admin.users.edit' , compact('u'));
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
            'name'  => 'required',
            'email' => 'email|required'
        ] , [
            'name.required'  => 'Ingresa el nombre del usuario',
            'email.required' => 'Ingresa el email del usuario',
            'email.email'    => 'Ingresa un email valido para el usuario',
            'email.unique'   => 'Ya existe un usuario creado con este email',
        ]);

        $u = User::find($id); 
        $u->name     = $request->name;
        $u->email    = $request->email;
        if ($request->cover) {
            $name_avatar = md5(uniqid().$request->cover->getClientOriginalName()).'.'.$request->cover->getClientOriginalExtension();
            @unlink(public_path().'/files/users/'.$u->avatar);
            $u->avatar = url('/files/users/'.$name_avatar);
            $request->cover->move(public_path().'/files/users/' , $name_avatar);
        }
        $u->save();

        return back()->with('msj' , 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::find($id);
        $msj = 'Bloqueado';
        if ($u->status == 0) {
            $u->status =  1;
            $msj = 'Activado';
        }else{
            $u->status = 0;
            $msj = 'Bloqueado';
        }
        $u->save();

        return back()->with('msj' , 'Usuario '.$msj.' exitosamente');
    }
}
