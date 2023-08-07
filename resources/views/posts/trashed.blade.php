@extends('layouts\app')
@section('content')

@if (count($errors) > 0)
<ul>
    @foreach ($errors->all() as $item)
        <li>
            {{$item}}
        </li>
    @endforeach
</ul>
@endif

<div class="container">
<table class="table">
    <thead>
          
      
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">Name</th>
        <th scope="col">image</th>
        <th scope="col">action</th>

      </tr>
    </thead>
    <tbody>
@php
$i=0;    
@endphp
      @foreach ($post as $item)
      @php
        
       $i++  
      @endphp
      <tr>
        <th scope="row">{{$i}}</th>
        <td>{{$item->name}}</td>
        <td>{{$item->description}}</td>
        <td>{{$item->user->name}}</td>
        <td>
          <img src="/{{$item->image}}" alt="{{$item->image}}"
          class="img-tumbnail" width="100" height="100">
</td>
        <td>
         
         <form name="myform"  action="{{route('posts.hdelete',$item->id)}}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="bi bi-recycle"></i></button>
        </form>
        <button type="button" class="btn btn-warning">
            <a href="{{route('posts.restorePost',$item->id)}}">
                <i class="bi bi-arrow-clockwise"></i>
            </a>
        </button>

       </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {!! $post->links() !!}
</div>
@endsection