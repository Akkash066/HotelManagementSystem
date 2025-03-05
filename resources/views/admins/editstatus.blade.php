@extends('layouts.admin')

@section('content')



<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Status</h5>
                <p>Current Status: <b>{{$booking->status}}</b></p>
                <form method="POST" action="{{route('bookings.update.status', $booking->id)}}" enctype="multipart/form-data">
                    <!-- Email input -->
                    @csrf

                    <select name="status" class="form-control">

                        <option>Choose Hotel Name</option>

                       

                        <option value="Processing">Processing</option>
                        <option value="Booked Successfully">Booked Successfully</option>

                    
                    </select>
                    <br>

                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                </form>

            </div>
        </div>
    </div>
</div>

@endsection