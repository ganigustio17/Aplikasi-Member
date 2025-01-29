<?php

namespace App\Http\Controllers\Member;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{  
    protected $type = 'page';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        
        $user = Auth::user();
        $search = $request->search; 
    
        $data = Post::where('type', $this->type)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('title', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%');
                }
            })->orderBy('id', 'asc') ->paginate(10)->withQueryString();
    
        return view('member.page.index', compact('data'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:10240'
        ],[
            'title.required' => 'Judul wajib di isi',
            'content.required' => 'Konten wajib di isi',
            'thumbnail.image' => 'File harus berupa gambar',
            'thumbnail.mimes' => 'File harus berupa jpg,jpeg,png',
            'thumbnail.max' => 'File tidak boleh lebih dari 10MB'
        ]);

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $destination_path = public_path('thumbnails');
            $image->move($destination_path, $image_name);
        }

        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'status'=>$request->status,
            'thumbnail'=>isset($image_name) ? $image_name: null,
            'slug' =>Str::slug($request->title),
            'user_id' => Auth::user()->id,
            'type' => $this->type

        ];

        $count = 1;
        while(Post::where('slug', $data['slug'])->exists()){
            $data['slug'] = $data['slug'] . '-' . $count;
            $count++;
        }

        Post::create($data);

        return redirect()->route('member.page.index')->with('success', 'Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        if($post->type != $this->type){
            return redirect()->route('member.page.index');
        }
        return view('member.page.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:10240'
        ],[
            'title.required' => 'Judul wajib di isi',
            'content.required' => 'Konten wajib di isi',
            'thumbnail.image' => 'File harus berupa gambar',
            'thumbnail.mimes' => 'File harus berupa jpg,jpeg,png',
            'thumbnail.max' => 'File tidak boleh lebih dari 10MB'
        ]);

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $destination_path = public_path('thumbnails');
            $image->move($destination_path, $image_name);
        }

        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'status'=>$request->status,
            'thumbnail'=>isset($image_name) ? $image_name: $post->thumbnail,
            'slug' =>Str::slug($request->title)

        ];

        $count = 1;

        while(Post::where('slug', $data['slug'])->where('id', '!=', $post->id)->exists()){
            $data['slug'] = $data['slug'] . '-' . $count;
            $count++;
        }

        $post->update($data);

        return redirect()->route('member.page.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {  
        $thumbnailPath = public_path('thumbnails/' . $post->thumbnail);
    
        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }
    
        Post::where('id', $post->id)->where('thumbnail', $post->thumbnail)->where('type', $this->type)->delete();
    
        return redirect()->route('member.page.index')->with('success', 'Data berhasil di hapus');
    }
    

    private function generateSlug($title, $id = null){
      $slug = Str::slug($title);
      $count = Post::where('slug', $slug)->when($id, function($query,$id) {
        return $query->where('id', '!=', $id);
      })->count();

      if($count>0){
        $slug = $slug . "-" . ($count + 1);
      }

      return $slug;
    }
}
