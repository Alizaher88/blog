<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
        $this->middleware('verified');
    }

    public function index()
    {
      $post = (Auth::id()!= null) ? Post::latest()->where('user_id', Auth::id())->paginate(4)
       : Post::latest()->paginate(4);
      return view('posts.index',compact('post'));

    }

    public function trashed()
    {
        $post=Post::onlyTrashed()->latest()->where('user_id', Auth::id())->paginate(4) ;
        return view('posts.trashed',compact('post'));
    }
    public function create()
    {
      return view('posts.create');  
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'name'=> 'required',
        'description'=> 'required',
        'image'=> 'required|image',
      ]);
      $image = $request->image;
      $newimage = time().$image->getClientOriginalName();
      //dd($newimage);
      $image->move('uploads/posts',$newimage);
      $id = Auth::id();
      $slug = Str::slug($request->name, '@','en',['@'=>'v']);


     $post=Post::create([
       
       'name'=> $request->name,
       'description'=>$request->description,
       'image'=>'uploads/posts/'.$newimage,
       'user_id' => $id,
       'slug' => $slug,

     ]);
     
     return redirect()->route('posts.index')->with('success','Post created successfully');
    }
    public function show($slug)
    {
      $post = Post::where('slug' , $slug )->first();

        return view('posts.show')->with('post', $post);
    }

    
    public function edit($id)
    {
        $post=Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
      $post=Post::find($id);
      
        $this->validate($request,[
            'name'=> 'required',
            'description'=> 'required',
            'image'=> 'image',
          ]);
          if($request->has('image')){
          $image = $request->image;
      $newImage = time().$image->getClientOriginalName();
      $image->move('uploads/posts',$newImage);
      $post->image = 'uploads/posts/'.$newImage;
          }
          $post->name = $request->name;
          $post->description = $request->description;
         // dd($post);
          $post->save();
          return redirect()->route('posts.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $post=Post::find($id)->delete();
        return redirect()->route('posts.index') ;
    }

    public function hdelete($id)
    {
       //dd($id); 
       $post=Post::withTrashed()->where('id' ,  $id )->forceDelete();
    
    return redirect()->route('posts.trashed') ;
    }
    public function restorePost($id)
    {
       //dd($id); 
       $post=Post::withTrashed()->where('id' ,  $id )->restore();
    
    return redirect()->route('posts.trashed') ;
    }

    
}
