<?php
namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Hotel\Hotel;
use App\Models\Booking\Booking;
use App\Models\Apartment\Apartment;
use Illuminate\Support\Facades\Hash;
use Redirect;
use File;
class AdminController extends Controller{
    public function viewLogin(){
        return view('admins.login');
    }
    public function checkLogin(Request $request){
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            return redirect()->route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }
    public function index(){
        $adminsCount = Admin::select()->count();
        $hotelsCount = Hotel::select()->count();
        $roomsCount = Apartment::select()->count();
        return view('admins.index', compact('adminsCount', 'hotelsCount', 'roomsCount'));
    }
    public function alladmins(){
        $admins = Admin::select()->orderBy('id', 'desc')->get();
        return view('admins.alladmins', compact('admins'));
    }
    public function createAdmins(){
        return view('admins.createadmins');
    }
    public function storeAdmins(Request $request){
        $storeAdmins = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        if ($storeAdmins) {
            return Redirect::route('admins.all')->with(['success' => 'Admin Created Successfully']);
        }
    }
    public function allHotels(){
        $hotels = Hotel::select()->orderBy('id', 'desc')->get();
        return view('admins.allhotels', compact('hotels'));
    }
    public function createHotels(){
        return view('admins.createhotels');
    }
    public function storeHotels(Request $request){
        Request()->validate([
            "name" => "required|max:40",
            "image" => "required|max:888",
            "description" => "required",
            "location" => "required|max:40",
        ]);
        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);
        $storeHotels = Hotel::create([
            "name" => $request->name,
            "image" => $myimage,
            "description" => $request->description,
            "location" => $request->location,

        ]);
        if ($storeHotels) {
            return Redirect::route('hotels.all')->with(['success' => 'Hotel Created Successfully']);
        }
    }
    public function editHotels($id){
        $hotel = Hotel::find($id);
        return view('admins.edithotels', compact('hotel'));
    }
    public function updateHotels(Request $request, $id){
        Request()->validate([
            "name" => "required|max:40",
            "description" => "required",
            "location" => "required|max:40",
        ]);
        $hotel = Hotel::find($id);
        $hotel->update($request->all());
        if ($hotel) { 
            return Redirect::route('hotels.all')->with(['update' => 'Hotel updated Successfully']);
        }
    }
    public function deleteHotels($id){
        $hotel = Hotel::find($id);
        if(File::exists(public_path('assets/images/' . $hotel->image))){
            File::delete(public_path('assets/images/' . $hotel->image));
        }else{
            //dd('File does not exists.');
        }
        $hotel->delete();
        if ($hotel) {   
            return Redirect::route('hotels.all')->with(['delete' => 'Hotel deleted Successfully']);
        }
    }
    public function allRooms(){
        $rooms = Apartment::select()->orderBy('id', 'desc')->get();
        return view('admins.allrooms', compact('rooms'));
    }
    public function createRooms(){
        $hotels = Hotel::all();
        return view('admins.createrooms', compact('hotels'));
    }
    public function storeRooms(Request $request){
        // Request()->validate([
        //     "name" => "required|max:40",
        //     "image" => "required|max:888",
        //     "description" => "required",
        //     "location" => "required|max:40",
        // ]);
        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);
        $storeRooms = Apartment::create([
            "name" => $request->name,
            "image" => $myimage,
            "max_persons" => $request->max_persons,
            "size" => $request->size,
            "view" => $request->view,
            "num_beds" => $request->num_beds,
            "price" => $request->price,
            "hotel_id" => $request->hotel_id,

        ]);
        if ($storeRooms) {
            return Redirect::route('rooms.all')->with(['success' => 'Room Created Successfully']);
        }
    }
    public function deleteRooms($id){
        $room = Apartment::find($id);
        if(File::exists(public_path('assets/images/' . $room->image))){
            File::delete(public_path('assets/images/' . $room->image));
        }else{
            //dd('File does not exists.');
        }
        $room->delete();
        if ($room) {
            return Redirect::route('rooms.all')->with(['delete' => 'Room deleted Successfully']);
        }
    }
    public function allBookings(){
        $bookings = Booking::select()->orderBy('id', 'desc')->get();
        return view('admins.allbookings', compact('bookings'));
    }
    public function editStatus($id){
        $booking = Booking::find($id);
        return view('admins.editstatus', compact('booking'));
    }
    public function updateStatus(Request $request, $id){
        // Request()->validate([
        //     "name" => "required|max:40",
        //     "description" => "required",
        //     "location" => "required|max:40",
        // ]);
        $status = Booking::find($id);
        $status->update($request->all());
        if ($status) {
            
            return Redirect::route('bookings.all')->with(['update' => 'Status updated Successfully']);
        }
    }



    public function deleteBookings($id)
    {

        $booking = Booking::find($id);

        $booking->delete();

        if ($booking) {
            
            return Redirect::route('bookings.all')->with(['delete' => 'Booking deleted Successfully']);
        }
    }

    



}
