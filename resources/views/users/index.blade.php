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
  <a href="{{route('users.create')}}" class="nav-link btn btn-primary" >
    <i class="bi bi-bag-plus-fill"> Create</i></a>
     
     
  @endauth
 
<table class="table">
    <thead>
          
      
      <tr>
        
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
       
        <th scope="col">action</th>

      </tr>
    </thead>
    <tbody>
@php
$i=0;    
@endphp
      @foreach ($user as $item)
      @php
        
       $i++  
      @endphp
      <tr>
        <th scope="row">{{$i}}</th>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        
       
        <td scope="row">
         
          
         @auth
         <form id="my_form"  action="{{route('users.destroy',$item->id)}}" method="POST">
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
  {!! $user->links() !!}
</div>
@endsection