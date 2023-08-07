@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
      <div class="col">


    </div>
    <div class="row">



      <div class="col">

        <div class="card"  >
            <img src="{{URL::asset($post->image)}}" class="card-img-top" alt="{{$post->image}}">
            <div class="card-body">
              <h5 class="card-title">{{$post->name}}</h5>
              <p class="card-text"> {{$post->description}}</p>
            <p> Created at:   {{$post->created_at->diffForhumans() }}</p>
            <p>  Updated at:    {{$post->updated_at->diffForhumans() }}</p>



<br>

              
            </div>
          </div>

      </div>
    </div>
  </div>
@endsection


