@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
@endpush
@section('titulo')
    Crear una nueva Publicación
@endsection

@section('contenido')
    
    <div class="md:flex md:items-center  ">
        <div class="md:w-1/2 pr-5">
            <form id="dropzone"  action="{{route('imagenes.store')}}" method="post" class="dropzone border-dashed border-2 h-80 rounded flex  flex-col justify-center items-center">
            @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{route('posts.store')}}" method="POST" >
                @csrf
                <div class="mb-2">
                    <label id="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input type="text"  name="titulo" id="titulo" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{old('titulo')}}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div>
                    <label id="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripcion
                    </label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la publicación" class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror" >
                        {{old('descripcion')}}
                    </textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <input type="hidden" name="imagen" value="{{old('imagen')}}">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear Publicación" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>

Dropzone.autoDiscover = false;
let myDropzone = new Dropzone("#dropzone",{
    dictDefaultMessage: 'Sube tu imagen',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks:true,
    dictRemoveFile:"Borrar archivos",
    maxFiles: 1,
    uploadMultiple:false,
    init:function(){
        if(document.querySelector("[name='imagen']").value.trim()){
            const imagenPublicada={};
            imagenPublicada.size=1234;
            imagenPublicada.name=document.querySelector("[name='imagen']").value;

            this.options.addedfile.call(this,imagenPublicada);
            this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add(
            "dz-success",
            "dz-complete");
        }
    }
});

myDropzone.on('success', function(file, response){
    document.querySelector("[name='imagen']").value=response.imagen;
});

myDropzone.on('removedfile', function(){
    document.querySelector("[name='imagen']").value="";
});

</script>
@endsection