@extends('layouts.app')

@section('content')



<div class="hero-wrap js-fullheight" style="margin-top: -25px; background-image: url('{{asset('assets/images/room-1.jpg')}}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <h1 class="subheading">My Bookings</h1>
                <h1 class="mb-4"></h1>
                <!-- <p><a href="{{ route('home')}}" class="btn btn-primary">Go Home</a> </p>  -->
            </div>
        </div>
    </div>
</div>

<div class="container"> 
<table class="table">
  <thead>
    <tr>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">phone_number</th>
      <th scope="col">check_in</th>
      <th scope="col">check_out</th>
      <th scope="col">days</th>
      <th scope="col">price</th>
      <th scope="col">room_name</th>
      <th scope="col">hotel_name</th>
      <th scope="col">status</th>
    </tr>
  </thead>
  <tbody>

    @foreach( $bookings as $booking)
    <tr>
      <th scope="row">{{$booking->name }}</th>
      <td>{{$booking->email }}</td>
      <td>{{$booking->phone_number }}</td>
      <td>{{$booking->check_in }}</td>
      <td>{{$booking->check_out }}</td>
      <td>{{$booking->days }}</td>
      <td>{{$booking->price }}</td>
      <td>{{$booking->room_name }}</td>
      <td>{{$booking->hotel_name }}</td>
      <td>{{$booking->status }}</td>
     
    </tr>
   @endforeach
  </tbody>
</table>

</div>

@endsection
