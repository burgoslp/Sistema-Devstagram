@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                
                <img src="{{$user->imagen ? asset('/perfiles').'/'.$user->imagen:asset('/img/usuario.png')}}" alt="imagen de usuario">
            </div>
            <div  class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center justify-center md:items-start py-10 md:py-10">

                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('perfil.index')}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-600 text-sm mb-3 font-bold mt-5">
                    {{$user->followers->count()}}
                    <span class="font-normal">@choice('seguidor|seguidores',$user->followers->count())</span>
                </p>
                <p class="text-gray-600 text-sm mb-3 font-bold">
                    {{$user->followings->count()}}
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('users.followers',$user)}}" class="font-normal hover:text-black">Siguiendo</a>
                        @else
                            <span class="font-normal hover:text-black">Siguiendo</span>                       
                        @endif
                    @endauth
                    @guest
                        <span class="font-normal hover:text-black">Siguiendo</span>      
                    @endguest
                </p>

                <p class="text-gray-600 text-sm mb-3 font-bold">
                    {{$user->posts()->count()}}
                    <span class="font-normal">Posts</span>
                </p>

                @auth
                   @if ($user->id !== auth()->user()->id)
                        @if (!$user->validateFollower(auth()->user()))
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
                   @endif                   
                @endauth
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        <x-listar-post :posts="$posts" />
        <div class="mt-10">
            {{$posts->links()}}
        </div>
    </section>
@endsection
