@extends('layouts.app')
@section('titulo')
    Página Principal
@endsection
@section('contenido')
    <section class="container mx-auto mt-10 md:flex gap-4">
        <div class="md:w-3/4">
            <x-listar-post :posts="$posts">
                <x-slot:autenticado>
                        <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones, sigue más usuarios.</p>
                </x-slot:autenticado>
                <x-slot:invitado>
                        <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones.</p>
                </x-slot:invitado>
            </x-listar-post>
            <div class="mt-10">
                {{$posts->links()}}
            </div>
        </div>
        <div class="md:w-1/4 mt-10 md:mt-0 ">  
            @auth
                @if($usersFollowings->count())
                    <x-listar-followers :users="$usersFollowings" />                
                @else
                    <x-listar-user :users="$users" />
                @endif
            @endauth              
            @guest
                <x-listar-user :users="$users" />
            @endguest                
        </div>
    </section>
@endsection