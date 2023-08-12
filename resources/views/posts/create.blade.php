@extends('layouts\app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">{{__('Create Post')}}</h1>
           </div>
      </div>

    </div>
    <div class="row">
{{-- 
        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    {{$item}}
                </li>
            @endforeach
        </ul>
        @endif --}}


      <div class="col">
      <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group mb-3">
              <label for="exampleFormControlInput1">{{__('Title')}}  </label>
             
              <input type="text"  id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  >
              
               @error('name')
                    <small class="help-block text-danger">{{$message}}</small>
              @enderror
            </div>
            
            <div class="form-group mb-3">
              <label for="exampleFormControlTextarea1">{{__('content')}}  </label>
              <textarea class="form-control @error('description') is-invalid @enderror"  name="description"   rows="3"></textarea>
              @error('description')
                            <small class="help-block text-danger">{{$message}}</small>
              @enderror 
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1">{{__('Photo') }} </label>
                <input type="file"  name="image" class="form-control @error('image') is-invalid @enderror"   >
                @error('image')
                   <small class="help-block text-danger">{{$message}}</small>
              @enderror 

              </div>

            <div class="form-group mb-3">

                <button class="btn btn-danger" type="submit">{{__('save')}}</button>
            </div>

          </form>
      </div>
    </div>
  </div>

@endsection