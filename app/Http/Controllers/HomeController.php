<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {   
       if(auth()->user()){
            $followings=auth()->user()->followings->pluck('id')->toArray();
            $posts=Post::whereIn('user_id',$followings)->latest()->paginate(20);
            $users=User::whereIn('id',$followings)->latest()->get();
       }else{
            $posts=Post::cursorPaginate(20);
            $users=User::paginate(10);
       }
    
      
       return view('home',["posts"=>$posts,"users"=>$users]);
    }
}
