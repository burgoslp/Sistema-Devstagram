<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLike;
    public $likeCount=0;

    public function mount($post){
        $this->isLike = $post->checkLike(auth()->user());
        $this->likeCount=$this->post->likes()->count();
    }

    public function like()
    {

        if ($this->post->checkLike(auth()->user())){
             
           $this->post->likes()->where('post_id',$this->post->id)->where('user_id',auth()->user()->id)->delete();
           $this->isLike=false;
           $this->likecount();
        }else{
            $this->post->likes()->create([
                'user_id'=>auth()->user()->id
            ]);   
            $this->isLike=true;
            $this->likecount();
        }
        return 'desde la funcion like';
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    public function likecount(){
        $this->likeCount=$this->post->likes()->count();
        return $this->likeCount;
    }

}
