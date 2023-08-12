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
        <i class="bi bi-bag-plus-fill">{{ __('indexpost.Create') }} </i></a>
        <a href="{{route('posts.trashed')}}" class="nav-link nav-link btn btn-danger"  >
          <i class="bi bi-trash-fill ">{{__('indexpost.trashed')}}</i>
        </a> 
      
    @endauth
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>

    @endif
  <table class="table"> 
    <thead>
          
      
      <tr>
        <th scope="col">

        </th>
        <th scope="col">{{__('indexpost.name')}}</th>
        <th scope="col">{{__('indexpost.description')}}</th>
        <th scope="col">{{__('indexpost.Name')}}</th>
        <th scope="col">{{__('indexpost.image')}}</th>
        <th scope="col">{{__('indexpost.action')}}</th>

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
  
        {{-- {!! $post->links() !!} --}}
        {{ $post->links('pagination::simple-bootstrap-5') }}



     
  </nav>
 
</div>
@endsection