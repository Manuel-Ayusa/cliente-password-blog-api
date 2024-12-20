<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Paginate;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class PostsIndex extends Component
{
    use Paginate;

    public $search, $path = 'posts';

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        Paginator::useBootstrap();//para usar los estilos de bootstrap en la paginación

        $userId = auth()->user()->id;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/posts?filter[user_id]=' . $userId . '&&filter[name]=' . $this->search . '&&included=images,tags,user&&sort=-id'); 

        $response = json_decode($response);
        $posts = $response->data;

        $posts = $this->paginate($posts, 8);
        $posts->setPath($this->path);

        return view('livewire.admin.posts-index', compact('posts', 'userId'));
    }
}
