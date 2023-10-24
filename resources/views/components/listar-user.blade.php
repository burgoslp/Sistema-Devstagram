<div>
    <div class="shadow bg-white p-5 mb-2">
        <h1 class="font-bold text-center uppercase">
            Usuarios  Sugeridos
        </h1>    
   </div>
   <div  class="shadow bg-white p-5 mb-2">
        <ul>      
             
            @foreach ($users as $user)   
                @if ($user->id !== auth()->user()->id)
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
                            <p class="text-xs text-gray-500">{{$user->followers->count()}} @choice('seguidor|seguidores',$user->followers->count())</p>
                            <p class="text-xs text-gray-500">{{$user->posts->count()}} @choice('Publicacion|Publicaciones',$user->posts->count())</p>
                        </div>
                    </li>        
                @endif                                     
            @endforeach            
        </ul>               
   </div>
</div>