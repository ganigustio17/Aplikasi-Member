<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        $lastData = $this->lastData();

        if (!$lastData) {
            return view('home.guest');
        }

         
        $data = Post::where('status', 'publish')->where('type', 'blog')->where('id', '!=', $lastData->id)->orderBy('id', 'desc')->paginate(5);

        
                    
        return view('components.front.home', compact('data','lastData'));
    }

    private function lastData()
    {
        return Post::where('status', 'publish')->where('type', 'blog')->orderBy('id', 'desc')->latest()->first();
    }
}
