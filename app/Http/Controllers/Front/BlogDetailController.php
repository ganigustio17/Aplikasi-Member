<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogDetailController extends Controller
{
    function detail($slug){

        $data = Post::where('status', 'publish')->where('slug', $slug)->where('type', 'blog')->firstOrFail();
        $pagination = $this->pagination($data->id);
        return view('components.front.blog-detail', compact('data','pagination'));
    }

    private function pagination($id){

        $dataPrev = Post::where('status', 'publish')->where('id', '<', $id)->where('type', 'blog')->orderBy('id','asc')->first();
        $dataNext = Post::where('status', 'publish')->where('id', '>', $id)->where('type', 'blog')->orderBy('id','desc')->first();

        $data = [
            'prev'=>$dataPrev,
            'next'=>$dataNext
        ];

        return $data;
    }

}
