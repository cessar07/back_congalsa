<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Auth;

use App\Entry;

use App\Recipe;

use App\Event;

use App\Question;

use App\Option;

use App\Social;

use App\VideoQuestion;

use App\Group;

use App\GroupMessage;

use App\GroupUser;

use App\Message;

use App\UserRecipe;

use App\UsersEvent;

use App\UserPoints;

use App\Bonus;

use App\Product;

use App\USerProduct;

use DateTime;

class ApiController extends Controller
{
    public function postLogin(Request $r){
    	if (!$r->user) {
	    	return response()->json([
	    		'success' => false,
	    		'msj' => 'Ingresa tu usuario'
	    	]);
    	}

    	if (!$r->password) {
	    	return response()->json([
	    		'success' => false,
	    		'msj' => 'Ingresa tu contraseña'
	    	]);
    	}
    	
        $user = User::where('user' , $r->user)->first();
    	
        if ($user) {
            $u = Auth::attempt(['email' => $user->email, 'password' => $r->password , 'role' => 2]);
            if ($u) {
                $q = Question::where('status' , 1)->get()->random(3);
                $cq = 0;
                if (count($q) > 0) {
                    foreach ($q as $qt) {
                        $qt->options_data = $qt->getOpt;
                        $qt->video_info = VideoQuestion::all()->random(1)->first();
                        if ($cq == 0) {
                            $qt->first = 1;
                        }else{
                            $qt->first = 0;
                        }
                        $cq++;
                    }
                }
    	    	return response()->json([
    	    		'success'   => true,
    	    		'user'      => $user->id,
                    'data'      => json_encode($user),
                    'questions' => json_encode($q)
    	    	]);
            }else{
                return response()->json([
                    'success' => false,
                    'msj'    => 'Verifica tus datos'
                ]);
            }
    	}else{
    		return response()->json([
	    		'success' => false,
	    		'msj'    => 'Verifica tus datos'
	    	]);
    	}

    }

    public function getUSer($id){
        $u = User::find($id);
    	return json_encode($u);
    }

    public function getNews(){
        $n = Entry::where('status' , 1)->skip(0)->take(5)->get();
        return json_encode($n);
    }

    public function getRecipes(){
        $lr = Recipe::orderBy('id' , 'desc')->limit(5)->get();
        $r = Recipe::orderBy('id' , 'desc')->skip(0)->take(5)->get();
        if (count($r) > 0) {
            foreach ($r as $re) {
                $re->category_name = $re->getCategory()->title;
                if ($re->difficulty == 1) {
                    $re->dif = 'Facil';
                }elseif($re->difficulty == 2){
                    $re->dif = 'Medio';
                }else{
                    $re->dif = 'Dificil';
                }
                $re->ingredients = $re->getIng;
            }
        }

        if (count($lr) > 0) {
            foreach ($lr as $lre) {
                $lre->category_name = $lre->getCategory()->title;
                if ($lre->difficulty == 1) {
                    $lre->dif = 'Facil';
                }elseif($lre->difficulty == 2){
                    $lre->dif = 'Medio';
                }else{
                    $lre->dif = 'Dificil';
                }
                $lre->ingredients = $lre->getIng;
            }
        }
        return response()->json([
            'lr' => $lr,
            'r'  => $r
        ]);
    }

    public function getEvents(){
        $r = Event::skip(0)->take(5)->get();
        if (count($r) > 0) {
            foreach ($r as $re) {
                $re->dif = $re->getDiff();
            }
        }
        return json_encode($r);
    }

    public function getSocials(){
        $r = Social::skip(0)->take(5)->get();
        return json_encode($r);
    }

    public function getSocialsMore($skip){
        $r = Social::skip($skip)->take(5)->get();
        return json_encode($r);
    }

    public function getNewsMore($skip){
        $r = Entry::where('status' , 1)->skip($skip)->take(5)->get();
        return json_encode($r);
    }

    public function getEventsMore($skip){
        $r = Entry::where('status' , 1)->skip($skip)->take(5)->get();
        return json_encode($r);
    }

    public function uploadAvatar(Request $r , $id){
        $u = User::find($id);
        $name_avatar = md5(uniqid().$r->ionfile->getClientOriginalName()).'.'.$r->ionfile->getClientOriginalExtension();

        $u->avatar = url('/files/users/'.$name_avatar);
        $u->save();

        $r->ionfile->move(public_path().'/files/users' , $name_avatar);

        return response()->json([
            'fileUrl' => $u->avatar,
            'user'    => json_encode($u),
        ]);
    }

    public function uploadPhotoRecipe(Request $r , $recipe , $user){
        $name_file = md5(uniqid().$r->ionfile->getClientOriginalName()).'.'.$r->ionfile->getClientOriginalExtension();

        $pr = new UserRecipe;
        $pr->user_id   = $user;
        $pr->recipe_id = $recipe;
        $pr->file      = url('/files/recipes/users/'.$name_file);
        $pr->file_code = md5(uniqid());
        $pr->save();

        $r->ionfile->move(public_path().'/files/recipes/users/' , $name_file);

        return response()->json([
            'file' => json_encode($pr),
        ]);
    }

    public function uploadPhotoEvent(Request $r , $event , $user){
        $name_file = md5(uniqid().$r->ionfile->getClientOriginalName()).'.'.$r->ionfile->getClientOriginalExtension();

        $pr = new UsersEvent;
        $pr->user_id   = $user;
        $pr->event_id  = $event;
        $pr->file      = url('/files/events/users/'.$name_file);
        $pr->file_code = md5(uniqid());
        $pr->status    = 1;
        $pr->save();

        $r->ionfile->move(public_path().'/files/events/users/' , $name_file);

        return response()->json([
            'file' => json_encode($pr),
        ]);
    }

    public function updateUser(Request $r, $id){
        $u = User::find($id);
        $prev_u = User::where('user' , $r->user)->first();

        if ($prev_u) {
            if ($prev_u->id != $u->id) {
                return response()->json([
                    'success' => false,
                    'msj'     => 'Nombre de usuario ya tomado, Ingresa otro usuario'
                ]);
            }
        }

        $u->user = $r->user;
        $u->save();

        return response()->json([
            'success' => true,
            'msj'     => 'Usuario actualizado exitosamente',
            'user'    => json_encode($u)
        ]);
    }

    public function getMessages($id){
        $u = User::where('role' , 2)->where('id' , '!=' , $id)->get();
        $g = GroupUser::where('user_id' , $id)->get();

        if (count($g) > 0) {
            foreach ($g as $gr) {
                $msj = GroupMessage::where('group_id' , $gr->group_id)->orderBy('id' , 'asc')->get();
                $gr->userInfo  = User::find($id);
                $gr->groupInfo = Group::find($gr->group_id);

                if ($gr->groupInfo->type == 1) {
                    $u2 = GroupUser::where('group_id' , $gr->group_id)->where('user_id' , '!=' , $id)->first();

                    $gr->userInfo2 = User::find($u2->user_id);
                }

                if (count($msj) > 0) {
                    foreach ($msj as $m) {
                        $m->messageInfo = Message::find($m->message_id);
                        $m->userInfo    = User::find($m->messageInfo->user_id_from);
                    }
                }

                $gr->messages = $msj;
            }
        }

        return response()->json([
            'users'  => $u,
            'groups' => $g,
        ]); 
    }

    public function getMessagesother($user, $other){
        $g  = GroupUser::where('user_id' , $user)->get();
        $go = GroupUser::where('user_id' , $other)->get();
        $gg = '';
        $gu = '';
        $u1 = User::find($user);
        $u2 = User::find($other);

        if (count($g) > 0 && count($go) > 0) {
            foreach ($g as $gr) {
                foreach ($go as $gro) {
                    if ($gro->group_id == $gr->group_id) {
                        $gg = Group::find($gro->group_id);
                        if ($gg->type == 1) {
                            $gu = $gg;
                            $msj = GroupMessage::where('group_id' , $gu->id)->orderBy('id' , 'asc')->get();
                            if (count($msj) > 0) {
                                foreach ($msj as $m) {
                                    $m->messageInfo = Message::find($m->message_id);
                                    $m->userInfo    = User::find($m->messageInfo->user_id_from);
                                }
                            }
                            $gu->messages = $msj;
                        }
                    }
                }
            }
        }else{
            $gu = new Group;
            $gu->status = 1;
            $gu->title  = 'Grupo '.$u1->name.' y '.$u2->name;
            $gu->type   = 1; 
            $gu->save();

            $gu1 = new GroupUser;
            $gu1->user_id  = $user;
            $gu1->group_id = $gu->id;
            $gu1->save();

            $gu2 = new GroupUser;
            $gu2->user_id  = $other;
            $gu2->group_id = $gu->id;
            $gu2->save();

            $msj = GroupMessage::where('group_id' , $gu->id)->orderBy('id' , 'asc')->take(10)->get();
            if (count($msj) > 0) {
                foreach ($msj as $m) {
                    $m->messageInfo = Message::find($m->message_id);
                    $m->userInfo    = User::find($m->messageInfo->user_id_from);
                }
            }
            $gu->messages = $msj;
        }

        return response()->json([
            'group' => $gu,
        ]); 
    }

    public function sendMessage(Request $r){
        $m = new Message;
        $m->content      = $r->message;
        $m->user_id_from = $r->user;
        $m->group_id     = $r->group;
        $m->type         = 0;
        $m->save();

        $gm = new GroupMessage;
        $gm->group_id   = $r->group;
        $gm->message_id = $m->id;
        $gm->save();

        $m->messageInfo = Message::find($m->id);
        $m->userInfo    = User::find($m->messageInfo->user_id_from);
            

        return response()->json([
            'message' => $m
        ]);
    }

    public function updateDetailRecipe(Request $r , $id){
        $d = UserRecipe::find($id);
        if ($d) {
            $d->detail = $r->detail;
            $d->save();
            
            $b = Bonus::where('id' , 4)->first();

            $up = new UserPoints;
            $up->user_id  = $d->user_id;
            $up->points   = $b ? $b->points : 100;
            $up->date     = date('Y-m-d');
            $up->date_str = strtotime(date('Y-m-d'));
            $up->save();

            return response()->json([
                'success' => true,
                'msj'     => 'exito',
                'points'  => $b ? $b->points : 100
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Error'
            ]);
        }
    }

    public function updateDetailEvent(Request $r , $id){
        $d = UsersEvent::find($id);
        if ($d) {
            $d->detail = $r->detail;
            $d->save();

            $b = Bonus::where('id' , 5)->first();

            $up = new UserPoints;
            $up->user_id  = $d->user_id;
            $up->points   = $b ? $b->points : 2500;
            $up->date     = date('Y-m-d');
            $up->date_str = strtotime(date('Y-m-d'));
            $up->save();

            return response()->json([
                'success' => true,
                'msj'     => 'exito',
                'points'  => $b ? $b->points : 2500
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Error',
            ]);
        }
    }

    public function getRanking($id){
        $u  = User::where('role' , 2)->orderBy('points' , 'desc')->get();
        $cU = 1;
        if (count($u) > 0) {
            foreach ($u as $us) {
                if ($cU == 1) {
                    $us->rowClass = 'row_user_ranking_1';
                    $us->position = 1;
                }
                if ($cU == 2) {
                    $us->rowClass = 'row_user_ranking_2';
                    $us->position = 2;
                }
                if ($cU == 3) {
                    $us->rowClass = 'row_user_ranking_3';
                    $us->position = 3;
                }
                if ($cU > 3) {
                    $us->rowClass = 'row_user_ranking';
                    $us->position = $cU;
                }

                $cU++;
            }
        }
        return response()->json([
            'users' => $u
        ]);
    }

    public function getRankingSem($id){
        $u  = User::where('role' , 2)->orderBy('points' , 'desc')->get();
        $cU = 1;
        if (count($u) > 0) {
            foreach ($u as $us) {
                if ($cU == 1) {
                    $us->rowClass = 'row_user_ranking_1';
                    $us->position = 1;
                }
                if ($cU == 2) {
                    $us->rowClass = 'row_user_ranking_2';
                    $us->position = 2;
                }
                if ($cU == 3) {
                    $us->rowClass = 'row_user_ranking_3';
                    $us->position = 3;
                }
                if ($cU > 3) {
                    $us->rowClass = 'row_user_ranking';
                    $us->position = $cU;
                }

                $cU++;
            }
        }
        $p = Product::where('status' , 1)->get();

        return response()->json([
            'users' => $u,
            'products' => json_encode($p)
        ]);
    }

    public function getRankingMonth($id){
        $u  = User::where('role' , 2)->orderBy('points' , 'desc')->get();
        $cU = 1;
        if (count($u) > 0) {
            foreach ($u as $us) {
                if ($cU == 1) {
                    $us->rowClass = 'row_user_ranking_1';
                    $us->position = 1;
                }
                if ($cU == 2) {
                    $us->rowClass = 'row_user_ranking_2';
                    $us->position = 2;
                }
                if ($cU == 3) {
                    $us->rowClass = 'row_user_ranking_3';
                    $us->position = 3;
                }
                if ($cU > 3) {
                    $us->rowClass = 'row_user_ranking';
                    $us->position = $cU;
                }

                $cU++;
            }
        }
        $p = Product::where('status' , 1)->get();

        return response()->json([
            'users' => $u,
            'products' => json_encode($p)
        ]);
    }

    public function updatePoints($id , $points){
        $u = User::find($id);
        $u->points = $points;
        $u->save();

        return response()->json([
            'points' => $u->points
        ]);
    }

    public function exchangeProduct($pro , $us){
        $up = new USerProduct;
        $up->user_id    = $us;
        $up->product_id = $pro;
        $up->status     = 1;
        $up->save();

        $p = Product::find($pro);

        return response()->json([
            'success' => true,
            'points'  => $p ? $p->points : 100
        ]); 
    }

    public function getUserProducts($id){
        $pr = USerProduct::where('user_id' , $id)->get();

        if (count($pr) > 0) {
            foreach ($pr as $p) {
                $p->productInfo = Product::find($p->product_id);
                $date = new DateTime($p->created_at);
                $p->date_format = $date->format('d-m-Y');
            }
        }

        return response()->json([
            'products' => $pr
        ]);
    }
}
