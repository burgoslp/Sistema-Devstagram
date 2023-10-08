@extends('layouts.app')

@section('titulo')
    Editar Perfil {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center ">
        <div class="md:w-1/2  bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label id="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text"  name="username" id="username" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{auth()->user()->username}}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label id="file" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input type="file" name="file" id="file" class="border p-3 w-full rounded-lg">
                   
                </div>
                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
        
    </div>
@endsection