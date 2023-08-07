@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">Edit Post</h1>
           </div>
      </div>

    </div>
    <div class="row">

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    {{$item}}
                </li>
            @endforeach
        </ul>
        @endif


      <div class="col">
      <form action="{{route('posts.update',['id'=> $post->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Title  </label>
            <input type="text" name="name" value="{{$post->name}}"  class="form-control"   >
            </div>

            <div class="form-group">
               

                

        
              </div>


            <div class="form-group">
              <label for="exampleFormControlTextarea1">content  </label>
              <textarea class="form-control"   name="description"   rows="3"> {{$post->description}} </textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Photo  </label>
                <input type="file"  name="image" class="form-control"   >
              </div>

            <div class="form-group">

                <button class="btn btn-danger" type="submit">update</button>
            </div>

          </form>
      </div>
    </div>
  </div>
@endsection


