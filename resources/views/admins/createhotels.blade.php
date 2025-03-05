@extends('layouts.admin')

@section('content')





<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Hotels</h5>
          <form method="POST" action="{{ route('hotels.store')}}" enctype="multipart/form-data">
                <!-- Email input -->
                @csrf
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

                @if($errors->has('name'))
                <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                @endif

                <div class="form-outline mb-4 mt-4">
                  <input type="file" name="image" id="form2Example1" class="form-control" />
                 
                </div>

                @if($errors->has('image'))
                <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                @endif

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" placeholder="Description" rows="3"></textarea>
                </div>

                @if($errors->has('description'))
                <p class="alert alert-danger">{{ $errors->first('description') }}</p>
                @endif

                <div class="form-outline mb-4 mt-4">
                  <label for="exampleFormControlTextarea1" >Location</label>

                  <input type="text" name="location" id="form2Example1" class="form-control" placeholder="Location"/>
                 
                </div>

                @if($errors->has('location'))
                <p class="alert alert-danger">{{ $errors->first('location') }}</p>
                @endif

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
@endsection