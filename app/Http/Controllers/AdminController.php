<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use App\Bonus;

class AdminController extends Controller
{
    public function showIndex(){
    	return view('admin.index');
    }

    public function migrar(){
    	// Schema::create('socials', function (Blueprint $table) {
     //        $table->increments('id');
     //        $table->string('service')->nullable();
     //        $table->text('type')->nullable();
     //        $table->string('company')->nullable();
     //        $table->string('address')->nullable();
     //        $table->string('phone')->nullable();
     //        $table->text('conditions')->nullable();
     //        $table->integer('vigor')->nullable();
     //        $table->timestamps();
     //    }); 

        // Schema::create('video_questions', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title')->nullable();
        //     $table->text('file')->nullable();
        //     $table->integer('status')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('messages', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->text('content')->nullable();
        //     $table->integer('user_id_from')->nullable();
        //     $table->integer('user_id_to')->nullable();
        //     $table->integer('group_id')->nullable();
        //     $table->integer('type'); //0 texto, 1 imagen, 2 video, 3 link, 4 documento
        //     $table->text('file_url')->nullable();
        //     $table->text('file_original_name')->nullable();
        //     $table->text('file_original_extension')->nullable();
        //     $table->integer('deleted_to')->nullable(); //1 un usuario, 2 ambos usuarios
        //     $table->integer('deleted_to_id')->nullable(); //1 un usuario, 2 ambos usuarios
        //     $table->timestamps();
        // });

        // Schema::create('group_messages', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('message_id')->nullable();
        //     $table->integer('group_id')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('group_users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('user_id')->nullable();
        //     $table->integer('group_id')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('groups', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('status');
        //     $table->text('title');
        //     $table->integer('type');
        //     $table->integer('user_id')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('products', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('status');
        //     $table->string('title');
        //     $table->text('description');
        //     $table->text('cover');
        //     $table->bigInteger('points');
        //     $table->timestamps();
        // });

        // Schema::create('u_ser_products', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('user_id');
        //     $table->integer('product_id');
        //     $table->integer('status');
        //     $table->timestamps();
        // });

        // Schema::create('user_points', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('user_id');
        //     $table->integer('points');
        //     $table->date('date');
        //     $table->string('date_str');
        //     $table->timestamps();
        // });
    }

    public function bonus(){
        $b = Bonus::all();
        return view('admin.bonus' , compact('b'));
    }

    public function EditBonus($id){
        $b = Bonus::all();
        $bo = Bonus::find($id);
        return view('admin.bonus' , compact('b' , 'bo'));
    }

    public function storeBonus(Request $r){
        $r->validate([
            'activity' => 'required',
            'points' => 'required'
        ] , [
            'activity.required' => 'Ingresa la actividad del bonus',
            'points.required'   => 'Ingresa la puntuación del bonus',
        ]);

        $b = new Bonus;
        $b->activity = $r->activity;
        $b->points   = $r->points;
        $b->status   = 1;
        $b->save();

        return redirect('/admin/bonus')->with('msj' , 'Bonus agregado exitosamente');
    }

    public function updateBonus(Request $r){
        $r->validate([
            'activity' => 'required',
            'points' => 'required'
        ] , [
            'activity.required' => 'Ingresa la actividad del bonus',
            'points.required'   => 'Ingresa la puntuación del bonus',
        ]);

        $b = Bonus::find($id);
        $b->activity = $r->activity;
        $b->points   = $r->points;
        $b->save();

        return redirect('/admin/bonus')->with('msj' , 'Bonus actualizado exitosamente');
    }

    public function deleteBonus($id){
        $b = Bonus::find($id);
        $b->delete();
        return redirect('/admin/bonus')->with('msj' , 'Bonus eliminado exitosamente');
    }
}
