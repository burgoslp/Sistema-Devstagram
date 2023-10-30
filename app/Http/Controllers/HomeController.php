<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {   
       $users=0;
       $usersFollowings=0;
       if(auth()->user()){
            $followings=auth()->user()->followings->pluck('id')->toArray();
            $posts=Post::whereIn('user_id',$followings)->latest()->paginate(20);
            $usersFollowings=User::whereIn('id',$followings)->latest()->get();
            if(!$usersFollowings->count()){//si soy un nuevo ususario no tendré seguidores 
               $users=User::whereNotIn('id',[auth()->user()->id])->get();//muestra una cantidad de usuarios en caso de ser nuevo usuario
            }
       }else{
            $posts=Post::cursorPaginate(20);
            $users=User::paginate(10);  
       }          
       
       return view('home',["posts"=>$posts,"users"=>$users,"usersFollowings"=>$usersFollowings]);
    }
}
