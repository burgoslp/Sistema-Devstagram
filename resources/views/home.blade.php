@extends('layouts.app')
@section('titulo')
    Página Principal
@endsection
@section('contenido')
    <section class="container mx-auto mt-10 md:flex gap-4">
        <div class="md:w-3/4">
            @if($posts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{route('posts.show',['user'=>$post->user->username,'post'=>$post->id])}}"><img src="{{asset('uploads')."/".$post->imagen}}" alt="imagen del post {{$post->titulo}}"></a>
                    </div>
                @endforeach
            </div>
            
            @else 
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones de tus seguidores</p>
            @endif

            <div class="mt-10">
                {{$posts->links()}}
            </div>
        </div>
        <div class="md:w-1/4 ">
            <div class="shadow bg-white p-5 mb-2">
                 <h1 class="font-bold text-center uppercase">
                    @auth Usuarios Seguidos @endauth
                    @guest Usuarios Destacados @endguest
                 </h1>
            </div>
            <div  class="shadow bg-white p-5 mb-2">
                 <ul>
                        @foreach ($users as $user)
                            @if($user->followers->count())
                            <li class="flex items-center gap-2 mb-3">
                                <div class="w-1/5">
                                    @if($user->imagen != '')
                                        <img src="{{asset('perfiles').'/'.$user->imagen}}" alt="imagen de perfil del usuario" class="rounded">
                                    @else
                                            <img src="{{asset('img/usuario.png')}}" alt="imagen de perfil del usuario" class="rounded">
                                    @endif
                                </div>
                                <div class="w-1/2">
                                    <a href="{{route('posts.index',$user)}}" class="font-bold">{{$user->username}}</a>
                                    <p class="text-sm text-gray-500">{{$user->followers->count()}} @choice('seguidor|seguidores',$user->followers->count())</p>
                                </div>
                            </li>
                            @endif                       
                        @endforeach
                 </ul>               
            </div>
            <div  class="shadow bg-white p-5">
                <p class="uppercase font-bold text-center"><a  href="#" >ver más</a></p>
            </div>
         </div>
    </section>
@endsection