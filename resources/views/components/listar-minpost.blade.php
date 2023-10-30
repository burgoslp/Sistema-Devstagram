<div>
    <div class="shadow bg-white p-5 mb-2">
        <h1 class="font-bold text-center uppercase">
            Tus Publicaciones
        </h1>          
   </div>
   <div  class="shadow bg-white p-5 mb-2">
        <ul>        
            @if ($posts->count() !=0)
                @foreach ($posts as $post)            
                    @if($post->count())
                        <li class="flex items-center gap-2 mb-3">
                            <div class="w-1/4">
                                    <img src="{{asset('uploads').'/'.$post->imagen}}" alt="imagen de perfil del usuario" class="rounded">                               
                            </div>
                            <div class="w-3/4">
                                    <p class="text-sm ">{{$post->titulo}}</p>
                                    <p class="text-xs text-gray-600">{{$post->likes->count()}} @choice('Likes|Like',$post->likes->count())</p>
                                    <p class="text-xs text-gray-600">{{$post->comentarios->count()}} @choice('Comentarios|Comentario',$post->comentarios->count())</p>
                                    <p class="text-xs text-gray-600">{{$post->created_at->diffForhumans()}}</p>
                            </div>
                        </li>                       
                    @endif                       
                @endforeach 
            @else
                <p class="uppercase font-bold  text-center text-gray-600">No has creado publicaciones</p>
            @endif             
                       
        </ul>               
   </div>
</div>