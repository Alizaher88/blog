@extends('layouts\app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">Create User</h1>
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
      <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Name  </label>
              <input type="text" name="name" class="form-control"   >
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Email  </label>
              <input type="text" name="email" class="form-control"   >
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Mobile  </label>
              <input type="number" name="mobile" class="form-control"   >
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Password  </label>
              <input type="text" name="password" class="form-control"   >
            </div>
            <div class="form-group">

                <button class="btn btn-danger" type="submit">Add</button>
            </div>

          </form>
      </div>
    </div>
  </div>

@endsection