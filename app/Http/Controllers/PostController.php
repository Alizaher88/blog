<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
        $this->middleware('verified')->except('index','show');
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

    public function store(PostRequest $request)
    {
      
    //  $rules= $this->getRules();
    //  $messages=$this->getMessages();
     $validate=Validator::make($request->all(),$request->rules(),$request->messages());
     if($validate->fails())
     {
  
      return  redirect()->back()->withErrors($validate);
     }
     else
     {
      $image = $request->image;
      $newimage = time().$image->getClientOriginalName();
      $image->move('uploads/posts',$newimage);
      $id = Auth::id();
      $slug = Str::slug($request->name);

      $post=Post::create([
       
       'name'=> $request->name,
       'description'=>$request->description,
       'image'=>'uploads/posts/'.$newimage,
       'user_id' => $id,
       'slug' => $slug,

     ]);
     
     return redirect()->route('posts.index')->with('success',__('messages.Post created successfully'));
    }
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

    public function update(PostRequest $request, $id)
    {
        $post=Post::find($id);
        $validate=Validator::make($request->all(),$request->rules(),$request->messages());
        if($validate->fails())
        {
     
          return  redirect()->back()->withErrors($validate);
        }
        else
        {
          if($request->has('image'))
          {
            $image = $request->image;
            $newImage = time().$image->getClientOriginalName();
            $image->move('uploads/posts',$newImage);
            $post->image = 'uploads/posts/'.$newImage;
          }
          $post->name = $request->name;
          $post->description = $request->description;
          $post->save();
          return redirect()->route('posts.index')->with('success',__('messages.Post updated successfully'));
        }
  }

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

    // protected function getRules(){

    //   return  $rules=['name'=> 'required|max:100',
    //   'description'=> 'required',
    //   'image'=> 'required|image',];

       


    // }
    // protected function getMessages(){
    //   return $messages=[
    //     'name.required'=> __('messages.The Name is required'),
    //     'name.max'=> __('messages.The Name tall max 100 characters'),
    //     'description.required'=> __('messages.The Description is required'),
    //     'image.required'=> __('messages.The Image is required'),
    //     'image.image'=> __('messages.The type should be Image'),
        
    //   ];
    // }
  }
