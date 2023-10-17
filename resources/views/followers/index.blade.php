@extends('layouts.app')
@section('titulo')
    Mis Seguidores
@endsection
@section('contenido')
    <div class="container mx-auto md:flex md:gap-20 md:justify-center">
        <div class="md:w-7/12">            
            <div  class="shadow p-5 mb-2 bg-white">
                <ul>
                    @foreach ($user->followings as $following)
                        <li class="flex items-center gap-2 mb-3">
                            <div class="w-1/5">                        
                                <img src="{{asset('img/usuario.png')}}" alt="imagen de perfil del usuario" class="rounded">                        
                            </div>
                            <div class="w-1/2">
                                <a href="" class="font-bold">{{$following->username}}</a>
                                <p class="text-xs text-gray-500">{{$following->followers->count()}} @choice('seguidor|seguidores',$following->followers->count())</p>
                                <p class="text-xs text-gray-500">{{$following->posts->count()}} @choice('Publicacion|Publicaciones',$following->posts->count())</p>
                                {{!$following->validateFollower(auth()->user())}}
                                @if (!$following->validateFollower(auth()->user()))
                                    <form action="{{route('users.follow',$user)}}" method="post">
                                        @csrf
                                        <input type="submit" class="bg-blue-600 text-white uppdercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="seguir">
                                    </form>
                                @else
                                    <form action="{{route('users.unfollow',$user)}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <input type="submit" class="bg-red-600 text-white uppdercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar de seguir">
                                    </form>
                                @endif
                            </div>
                        </li>
                        @if (!$loop->last)
                        <hr>
                        @endif                    
                    @endforeach
                                           
                </ul>               
            </div> 
        </div>
        <div class="mt-10 md:mt-0 md:w-4/12 ">
            <x-listar-minpost :posts="$posts" />
        </div>
    </div>
@endsection