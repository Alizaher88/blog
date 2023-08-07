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
  @auth
  <a href="{{route('posts.create')}}" class="nav-link btn btn-primary" >
    <i class="bi bi-bag-plus-fill"> Create</i></a>
    <a href="{{route('posts.trashed')}}" class="nav-link nav-link btn btn-danger"  >
      <i class="bi bi-trash-fill ">trashed</i>
    </a> 
     
  @endauth
 
<table class="table">
    <thead>
          
      
      <tr>
        <th scope="col">

        </th>
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
        <td scope="row">
          @auth
          <button type="button" class="btn btn-secondary"><a href="{{route('posts.edit',$item->id)}}" class="nav-link" ><i class="bi bi-pencil-square"></i>
          </a></button>
              
          @endauth
          <button type="button" class="btn btn-success"><a href="{{route('posts.show',$item->slug)}}" class="nav-link" ><i class="bi bi-eye-fill"></i>
          </a></button>
         @auth
         <form id="my_form"  action="{{route('posts.destroy',$item->id)}}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="bi bi-calendar2-x-fill"></i> </button>
          
       </form>    
         @endauth
         
              </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {!! $post->links() !!}
</div>
@endsection